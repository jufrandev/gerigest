<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->unique()->userName(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'postal_code' => fake()->postcode(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Asignar roles aleatorios después de crear el usuario.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            
            $roles = Role::pluck('name')->toArray();
            $ids = [1, 2, 3, 4];

            if (!empty($roles) && !in_array($user->id, $ids)) {
                $role = fake()->randomElement($roles);
                $user->assignRole($role);
            }
        });
    }
}
