<?php

namespace Database\Factories;

use App\Models\NoteType;
use App\Models\Priority;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::inRandomOrder()->first()->id, // Usuario aleatorio
            'title' => $this->faker->sentence(6), // Título aleatorio
            'content' => $this->faker->paragraph(3), // Contenido aleatorio
            'note_type_id' => NoteType::inRandomOrder()->first()->id ?? null, // Tipo de nota aleatorio o null
            'priority_id' => Priority::inRandomOrder()->first()->id ?? null, // Prioridad aleatoria o null
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Fecha aleatoria
            'updated_at' => now(),
        ];
    }
}
