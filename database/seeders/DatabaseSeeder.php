<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PrioritySeeder::class,
            LocationSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ActivityTypeSeeder::class,
            ActivitySeeder::class,
            EventSeeder::class,
            NoteTypeSeeder::class,
            NoteSeeder::class,
        ]);
    }
}
