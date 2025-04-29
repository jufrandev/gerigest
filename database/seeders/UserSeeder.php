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
            'first_name' => 'Admin',
            'last_name' => 'User',
            'address' => '123 Admin St',
            'phone' => '1234567890',
            'postal_code' => '12345',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $sosiosanitario = User::factory()->create([
            'first_name' => 'Sociosanitario',
            'last_name' => 'User',
            'address' => '456 Sociosanitario St',
            'phone' => '0987654321',
            'postal_code' => '54321',
            'email' => 'sociosanitario@example.com',
            'password' => bcrypt('password'),
        ]);
        $sosiosanitario->assignRole('sociosanitario');

        $usuario = User::factory()->create([
            'first_name' => 'Paciente',
            'last_name' => 'User',
            'address' => '789 Paciente St',
            'phone' => '1122334455',
            'postal_code' => '67890',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
        ]);
        $usuario->assignRole('paciente');

        $familiar = User::factory()->create([
            'first_name' => 'Familiar',
            'last_name' => 'User',
            'address' => '321 Familiar St',
            'phone' => '5566778899',
            'postal_code' => '98765',
            'email' => 'familiar@example.com',
            'password' => bcrypt('password'),
        ]);
        $familiar->assignRole('familiar');
    }
}

