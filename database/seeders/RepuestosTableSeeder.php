<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repuesto;

class RepuestosTableSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nombre'=>'Filtro de aceite','descripcion'=>'Filtro para motor','precio'=>15.50,'stock'=>50],
            ['nombre'=>'Bujía','descripcion'=>'Bujía estándar','precio'=>8.20,'stock'=>100],
            ['nombre'=>'Pastillas de freno','descripcion'=>'Juego de pastillas','precio'=>45.00,'stock'=>30],
            ['nombre'=>'Correa de distribución','descripcion'=>'Correa reforzada','precio'=>120.00,'stock'=>10],
            ['nombre'=>'Amortiguador','descripcion'=>'Amortiguador delantero','precio'=>75.00,'stock'=>20],
            ['nombre'=>'Aceite 5W-30','descripcion'=>'Litro de aceite sintético','precio'=>12.00,'stock'=>200],
            ['nombre'=>'Filtro de aire','descripcion'=>'Filtro de aire motor','precio'=>18.00,'stock'=>40],
            ['nombre'=>'Radiador','descripcion'=>'Radiador completo','precio'=>250.00,'stock'=>5],
            ['nombre'=>'Batería','descripcion'=>'Batería 12V','precio'=>95.00,'stock'=>15],
            ['nombre'=>'Termostato','descripcion'=>'Termostato motor','precio'=>22.00,'stock'=>25],
        ];

        foreach ($items as $it) {
            Repuesto::create($it);
        }
    }
}
