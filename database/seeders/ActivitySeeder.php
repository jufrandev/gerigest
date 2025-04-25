<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Desayuno',
            'description' => 'Desayuno en salón',
            'location_id' => 2,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Almuerzo',
            'description' => 'Almuerzo en salón',
            'location_id' => 2,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Merienda',
            'description' => 'Merienda en salón',
            'location_id' => 2,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Cena',
            'description' => 'Cena en salón',
            'location_id' => 2,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Higiene Personal',
            'description' => 'Higiene personal en habitación',
            'location_id' => 1,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Terapia',
            'description' => 'Terapia en sala de terapia',
            'location_id' => 3,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);


        $data = [
            'name' => 'Recreación',
            'description' => 'Recreación en salón',
            'location_id' => 4,
            'activity_type_id' => 3,
            'created_by' => 1,
        ];
        Activity::create($data);

    }
}
