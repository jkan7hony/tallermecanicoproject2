<?php

namespace App\Http\Controllers;

use App\Models\DetalleServicio;
use App\Models\OrdenTrabajo;
use App\Models\Repuesto;
use Illuminate\Http\Request;

class DetalleServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleServicios = DetalleServicio::with('ordenTrabajo.vehiculo.cliente', 'repuesto')->latest()->get();

        return view('DetalleServicio.index', compact('detalleServicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ordenTrabajos = OrdenTrabajo::with('vehiculo.cliente')->latest()->get();
        $repuestos = Repuesto::orderBy('nombre')->get();

        return view('DetalleServicio.create', compact('ordenTrabajos', 'repuestos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'orden_trabajo_id' => 'required|exists:orden_trabajos,id',
            'repuesto_id' => 'required|exists:repuestos,id',
            'nombre' => 'required|string|max:120',
            'marca' => 'required|string|max:80',
            'stock' => 'required|integer|min:0',
        ], [
            'orden_trabajo_id.required' => 'Debes seleccionar una orden de trabajo.',
            'repuesto_id.required' => 'Debes seleccionar un repuesto.',
        ]);

        DetalleServicio::create($validated);

        return redirect()->route('detalle-servicios.index')->with('success', 'Detalle de servicio creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detalleServicio = DetalleServicio::with('ordenTrabajo.vehiculo.cliente', 'repuesto')->findOrFail($id);

        return view('DetalleServicio.show', compact('detalleServicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleServicio $detalleServicio)
    {
        $ordenTrabajos = OrdenTrabajo::with('vehiculo.cliente')->latest()->get();
        $repuestos = Repuesto::orderBy('nombre')->get();

        return view('DetalleServicio.edit', compact('detalleServicio', 'ordenTrabajos', 'repuestos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleServicio $detalleServicio)
    {
        $validated = $request->validate([
            'orden_trabajo_id' => 'required|exists:orden_trabajos,id',
            'repuesto_id' => 'required|exists:repuestos,id',
            'nombre' => 'required|string|max:120',
            'marca' => 'required|string|max:80',
            'stock' => 'required|integer|min:0',
        ]);

        $detalleServicio->update($validated);

        return redirect()->route('detalle-servicios.index')->with('success', 'Detalle de servicio editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleServicio $detalleServicio)
    {
        $detalleServicio->delete();

        return redirect()->route('detalle-servicios.index')->with('success', 'Detalle de servicio eliminado');
    }
}
