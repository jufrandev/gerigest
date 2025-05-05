<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    // protected $model = Event::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Usuario relacionado
            'created_by' => User::inRandomOrder()->first()->id, // Usuario que creó el evento
            'activity_id' => Activity::inRandomOrder()->first()->id, // Actividad relacionada
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'), // Hora de inicio
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'), // Hora de fin
        ];
    }
}
