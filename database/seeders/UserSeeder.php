<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        $sosiosanitario = User::factory()->create([
            'name' => 'Sociosanitario User',
            'email' => 'sociosanitario@example.com',
        ]);
        $sosiosanitario->assignRole('sociosanitario');

        $usuario = User::factory()->create([
            'name' => 'Usuario User',
            'email' => 'usuario@example.com',
        ]);
        $usuario->assignRole('usuario');

        $familiar = User::factory()->create([
            'name' => 'Familiar User',
            'email' => 'familiar@example.com',
        ]);
        $familiar->assignRole('familiar');
    }
}
