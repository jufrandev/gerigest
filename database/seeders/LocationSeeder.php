<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create(['name' => 'Habitación', 'description' => 'Habitación del paciente']);
        Location::create(['name' => 'Comedor', 'description' => 'Comedor del centro']);
        Location::create(['name' => 'Sala de Terapia', 'description' => 'Sala de terapia del centro']);
        Location::create(['name' => 'Sala de Entrenamiento', 'description' => 'Sala de entrenamiento del centro']);
    }
}
