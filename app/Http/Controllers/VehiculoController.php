<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->latest()->get();

        return view('Vehiculo.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view('Vehiculo.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'patente' => 'required|string|max:12|unique:vehiculos,patente',
            'marca' => 'required|string|max:80',
            'modelo' => 'required|string|max:80',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ], [
            'patente.unique' => 'La patente ya está registrada.',
            'cliente_id.required' => 'Debes seleccionar un cliente.',
        ]);

        Vehiculo::create($validated);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehiculo = Vehiculo::with('cliente', 'ordenTrabajos')->findOrFail($id);

        return view('Vehiculo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view('Vehiculo.edit', compact('vehiculo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'patente' => [
                'required',
                'string',
                'max:12',
                Rule::unique('vehiculos', 'patente')->ignore($vehiculo->id),
            ],
            'marca' => 'required|string|max:80',
            'modelo' => 'required|string|max:80',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ], [
            'patente.unique' => 'La patente ya está registrada.',
            'cliente_id.required' => 'Debes seleccionar un cliente.',
        ]);

        $vehiculo->update($validated);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado');
    }
}
