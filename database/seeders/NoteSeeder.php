<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\User;
use App\Models\NoteType;
use App\Models\Priority;

class NoteSeeder extends Seeder
{
    public function run()
    {
        Note::factory(100)->create();
    }
}
