<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesTableSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['rut' => '11111111-1','nombre' => 'Juan','apellido' => 'Pérez','telefono' => '912345678','email' => 'juan.perez@example.com'],
            ['rut' => '22222222-2','nombre' => 'María','apellido' => 'González','telefono' => '922345678','email' => 'maria.gonzalez@example.com'],
            ['rut' => '33333333-3','nombre' => 'Carlos','apellido' => 'Soto','telefono' => '932345678','email' => 'carlos.soto@example.com'],
            ['rut' => '44444444-4','nombre' => 'Ana','apellido' => 'Rivas','telefono' => '942345678','email' => 'ana.rivas@example.com'],
            ['rut' => '55555555-5','nombre' => 'Luis','apellido' => 'Torres','telefono' => '952345678','email' => 'luis.torres@example.com'],
            ['rut' => '66666666-6','nombre' => 'Sofia','apellido' => 'Vega','telefono' => '962345678','email' => 'sofia.vega@example.com'],
            ['rut' => '77777777-7','nombre' => 'Pablo','apellido' => 'Molina','telefono' => '972345678','email' => 'pablo.molina@example.com'],
            ['rut' => '88888888-8','nombre' => 'Laura','apellido' => 'Navarro','telefono' => '982345678','email' => 'laura.navarro@example.com'],
            ['rut' => '99999999-9','nombre' => 'Diego','apellido' => 'Castro','telefono' => '992345678','email' => 'diego.castro@example.com'],
            ['rut' => '10101010-0','nombre' => 'Isabel','apellido' => 'Rojas','telefono' => '902345678','email' => 'isabel.rojas@example.com'],
        ];

        foreach ($clientes as $c) {
            Cliente::create($c);
        }
    }
}
