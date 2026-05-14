<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenTrabajos = OrdenTrabajo::with('vehiculo.cliente')->latest()->get();

        return view('OrdenTrabajo.index', compact('ordenTrabajos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehiculo::with('cliente')->orderBy('patente')->get();

        return view('OrdenTrabajo.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_ingreso',
            'estado' => 'required|string|in:Pendiente,En proceso,Finalizada,Cancelada',
            'descripcion_problema' => 'required|string|max:2000',
            'costo_estimado' => 'required|integer|min:0',
        ], [
            'vehiculo_id.required' => 'Debes seleccionar un vehículo.',
            'estado.in' => 'El estado no es válido.',
            'fecha_salida.after_or_equal' => 'La fecha de salida no puede ser anterior a la de ingreso.',
        ]);

        OrdenTrabajo::create($validated);

        return redirect()->route('orden-trabajos.index')->with('success', 'Orden de trabajo creada con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ordenTrabajo = OrdenTrabajo::with('vehiculo.cliente', 'detalleServicios.repuesto')->findOrFail($id);

        return view('OrdenTrabajo.show', compact('ordenTrabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdenTrabajo $ordenTrabajo)
    {
        $vehiculos = Vehiculo::with('cliente')->orderBy('patente')->get();

        return view('OrdenTrabajo.edit', compact('ordenTrabajo', 'vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdenTrabajo $ordenTrabajo)
    {
        $validated = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_ingreso',
            'estado' => 'required|string|in:Pendiente,En proceso,Finalizada,Cancelada',
            'descripcion_problema' => 'required|string|max:2000',
            'costo_estimado' => 'required|integer|min:0',
        ], [
            'vehiculo_id.required' => 'Debes seleccionar un vehículo.',
            'estado.in' => 'El estado no es válido.',
            'fecha_salida.after_or_equal' => 'La fecha de salida no puede ser anterior a la de ingreso.',
        ]);

        $ordenTrabajo->update($validated);

        return redirect()->route('orden-trabajos.index')->with('success', 'Orden de trabajo editada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdenTrabajo $ordenTrabajo)
    {
        $ordenTrabajo->delete();

        return redirect()->route('orden-trabajos.index')->with('success', 'Orden de trabajo eliminada');
    }
}
