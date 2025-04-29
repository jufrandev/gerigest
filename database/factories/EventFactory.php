<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{

    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar start_time primero
        $startTime = $this->faker->dateTimeBetween('now', '+1 week', null);
        // Generar end_time basado en start_time
        $endTime = (clone $startTime)->modify(rand(1, 3) . ' hours');
        $data = [];
        $data = [
            // User aleatorio de la tabla users con rol de 'paciente' en tabla roles
            'user_id' => User::whereHas('roles', function ($query) {
                $query->where('name', 'paciente');
            })->inRandomOrder()->first()->id,

            // User aleatorio de la tabla users con rol de 'sociosanitario' o 'admin'
            'created_by' => User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['sociosanitario', 'admin']);
            })->inRandomOrder()->first()->id,

            // activity_id aleatorio de la tabla activities
            'activity_id' => \App\Models\Activity::inRandomOrder()->first()->id,

            // start_time aleatorio entre -1 week ahora + 1 week
            'start_time' => $startTime,

            // end_time aleatorio entre start_time y +1 hour
            'end_time' => $endTime,
        ];
        return $data;
    }
}
