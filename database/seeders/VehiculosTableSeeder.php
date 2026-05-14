<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\Cliente;

class VehiculosTableSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = ['Toyota','Ford','Chevrolet','Honda','Nissan','Hyundai','Kia','BMW','Mercedes','Volkswagen'];
        $modelos = ['ModelA','ModelB','ModelC','ModelD','ModelE','ModelF','ModelG','ModelH','ModelI','ModelJ'];

        $clientes = Cliente::all();
        if ($clientes->isEmpty()) {
            return;
        }

        foreach ($clientes as $i => $cliente) {
            Vehiculo::create([
                'cliente_id' => $cliente->id,
                'marca' => $marcas[$i % count($marcas)],
                'modelo' => $modelos[$i % count($modelos)],
                'anio' => 2010 + ($i % 13),
                'patente' => str_pad((string) (100000 + $i), 6, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
