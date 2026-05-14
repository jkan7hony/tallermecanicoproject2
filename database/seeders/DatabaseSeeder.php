<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ClientesTableSeeder;
use Database\Seeders\VehiculosTableSeeder;
use Database\Seeders\RepuestosTableSeeder;
use Database\Seeders\OrdenTrabajosTableSeeder;
use Database\Seeders\DetalleServiciosTableSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ClientesTableSeeder::class,
            VehiculosTableSeeder::class,
            RepuestosTableSeeder::class,
            OrdenTrabajosTableSeeder::class,
            DetalleServiciosTableSeeder::class,
        ]);
    }
}
