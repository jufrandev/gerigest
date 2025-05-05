<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios específicos
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'usuario@example.com')->first();

        // Crear eventos para el usuario admin@example.com
        Event::factory(20)->create([
            'user_id' => $admin->id,
            'created_by' => $admin->id,
        ]);

        // Crear eventos para el usuario usuario@example.com
        Event::factory(20)->create([
            'user_id' => $user->id,
            'created_by' => $admin->id, // Supongamos que los creó el admin
        ]);
    }
}
