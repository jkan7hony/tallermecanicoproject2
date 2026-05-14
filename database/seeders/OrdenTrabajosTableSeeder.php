<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use Carbon\Carbon;

class OrdenTrabajosTableSeeder extends Seeder
{
    public function run(): void
    {
        $vehiculos = Vehiculo::all();
        if ($vehiculos->isEmpty()) {
            return;
        }

        foreach ($vehiculos as $i => $vehiculo) {
            OrdenTrabajo::create([
                'vehiculo_id' => $vehiculo->id,
                'fecha_ingreso' => Carbon::now()->subDays(10 - $i),
                'fecha_salida' => null,
                'estado' => $i % 2 === 0 ? 'abierta' : 'cerrada',
                'descripcion_problema' => 'Revisión y mantenimiento general ' . ($i+1),
                'costo_estimado' => 50 + ($i * 10),
            ]);
        }
    }
}
