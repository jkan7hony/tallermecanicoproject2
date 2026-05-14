<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rut' => [
                'required',
                'string',
                'max:12',
                'regex:/^(?:\d{7,8}|\d{1,2}(?:\.\d{3}){2})-[\dkK]$/',
                function ($attribute, $value, $fail) {
                    if (! $this->isValidChileanRut($value)) {
                        $fail('❌ El RUT ingresado no es válido.');
                        return;
                    }

                    $rutComparable = $this->rutComparable($value);
                    $exists = Cliente::query()
                        ->whereRaw("UPPER(REPLACE(REPLACE(rut, '.', ''), '-', '')) = ?", [$rutComparable])
                        ->exists();

                    if ($exists) {
                        $fail('⚠️ El RUT ya está registrado en el sistema.');
                    }
                },
            ],
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'apellido' => 'required|string|max:50|regex:/^[\pL\s]+$/u',
            'telefono' => 'required|digits_between:1,9',
            'email' => 'required|string|email|max:100|unique:clientes,email',
        ], [
            'rut.regex' => '❌ El formato de RUT debe ser 12.345.678-5 o 12345678-5.',
            'email.unique' => '⚠️ El email ya está registrado en el sistema',
            'nombre.regex' => '❌ El nombre solo puede contener letras',
            'apellido.regex' => '❌ El apellido solo puede contener letras',
            'telefono.digits_between' => '❌ El teléfono debe tener entre 1 y 9 dígitos',
        ]);

        $validated['rut'] = $this->normalizeRut($validated['rut']);

        Cliente::create($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'apellido' => 'required|string|max:50|regex:/^[\pL\s]+$/u',
            'telefono' => 'required|digits_between:1,9',
            'email' => 'required|string|email|max:100|unique:clientes,email,' . $cliente->id
        ], [
            'email.unique' => 'El email ya está registrado en el sistema',
            'nombre.regex' => 'El nombre solo puede contener letras',
            'apellido.regex' => 'El apellido solo puede contener letras',
            'telefono.digits_between' => 'El teléfono debe tener entre 1 y 9 dígitos',
        ]);
        $cliente->update($validated);
        return redirect()->route('clientes.index')->with('success','Cliente editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success','Cliente eliminado'); 
    }

    private function normalizeRut(string $rut): string
    {
        $clean = $this->rutComparable($rut);
        $body = substr($clean, 0, -1);
        $dv = substr($clean, -1);

        return $body . '-' . $dv;
    }

    private function rutComparable(string $rut): string
    {
        return strtoupper(str_replace(['.', '-', ' '], '', $rut));
    }

    private function isValidChileanRut(string $rut): bool
    {
        $clean = $this->rutComparable($rut);

        if (! preg_match('/^\d{7,8}[0-9K]$/', $clean)) {
            return false;
        }

        $body = substr($clean, 0, -1);
        $providedDv = substr($clean, -1);

        $sum = 0;
        $factor = 2;

        for ($i = strlen($body) - 1; $i >= 0; $i--) {
            $sum += (int) $body[$i] * $factor;
            $factor = $factor === 7 ? 2 : $factor + 1;
        }

        $remainder = 11 - ($sum % 11);

        if ($remainder === 11) {
            $expectedDv = '0';
        } elseif ($remainder === 10) {
            $expectedDv = 'K';
        } else {
            $expectedDv = (string) $remainder;
        }

        return $providedDv === $expectedDv;
    }
}
