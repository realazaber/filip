<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Try to find a user that doesn't have a patient yet
        $user = User::doesntHave('patient')->inRandomOrder()->first();

        // If no such user exists, create a new one
        if (! $user) {
            $user = User::factory()->create();
        }

        return [
            'user_id' => $user->id,
            'description' => $this->faker->paragraph,
        ];
    }
}
