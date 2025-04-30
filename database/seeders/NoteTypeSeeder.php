<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('note_types')->insert([
            ['name' => 'info', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'incidencia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reclamación', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
