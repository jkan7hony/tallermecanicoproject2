<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\DetalleServicioController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('clientes', ClienteController::class);
Route::resource('vehiculos', VehiculoController::class);
Route::resource('orden-trabajos', OrdenTrabajoController::class)->parameters([
    'orden-trabajos' => 'orden_trabajo',
]);
Route::resource('repuestos', RepuestoController::class);
Route::resource('detalle-servicios', DetalleServicioController::class)->parameters([
    'detalle-servicios' => 'detalle_servicio',
]);
