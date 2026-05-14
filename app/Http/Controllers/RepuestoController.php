<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RepuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repuestos = Repuesto::latest()->get();

        return view('Repuesto.index', compact('repuestos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Repuesto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:120|unique:repuestos,nombre',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'nombre.unique' => 'El repuesto ya existe.',
        ]);

        Repuesto::create($validated);

        return redirect()->route('repuestos.index')->with('success', 'Repuesto creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $repuesto = Repuesto::findOrFail($id);

        return view('Repuesto.show', compact('repuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repuesto $repuesto)
    {
        return view('Repuesto.edit', compact('repuesto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repuesto $repuesto)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:120', Rule::unique('repuestos', 'nombre')->ignore($repuesto->id)],
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'nombre.unique' => 'El repuesto ya existe.',
        ]);

        $repuesto->update($validated);

        return redirect()->route('repuestos.index')->with('success', 'Repuesto editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repuesto $repuesto)
    {
        $repuesto->delete();

        return redirect()->route('repuestos.index')->with('success', 'Repuesto eliminado');
    }
}
