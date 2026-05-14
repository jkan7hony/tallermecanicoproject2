<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleServicio;
use App\Models\OrdenTrabajo;
use App\Models\Repuesto;

class DetalleServiciosTableSeeder extends Seeder
{
    public function run(): void
    {
        $ordenes = OrdenTrabajo::all();
        $repuestos = Repuesto::all();
        if ($ordenes->isEmpty() || $repuestos->isEmpty()) {
            return;
        }

        foreach ($ordenes as $i => $orden) {
            if ($i >= 10) break;
            $rep = $repuestos->get($i % $repuestos->count());
            $cantidad = min(5, max(1, ($i % 5) + 1));

            DetalleServicio::create([
                'orden_trabajo_id' => $orden->id,
                'repuesto_id' => $rep->id,
                'nombre' => $rep->nombre,
                'marca' => 'Marca' . ($i+1),
                'stock' => $cantidad,
            ]);
        }
    }
}
