<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Alimentación',
            'description' => 'Actividades relacionadas con la alimentación',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Higiene',
            'description' => 'Actividades relacionadas con la higiene personal',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Recreación',
            'description' => 'Actividades recreativas y de ocio',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Educación',
            'description' => 'Actividades educativas y formativas',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Deporte',
            'description' => 'Actividades deportivas y de ejercicio físico',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Cuidado Personal',
            'description' => 'Actividades relacionadas con el cuidado personal',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Socialización',
            'description' => 'Actividades de socialización y convivencia',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Terapia',
            'description' => 'Actividades terapéuticas y de rehabilitación',
        ];
        ActivityType::create($data);
        $data = [
            'name' => 'Otros',
            'description' => 'Otras actividades no clasificadas',
        ];
        ActivityType::create($data);

        ActivityType::factory(5)->create();


    }
}
