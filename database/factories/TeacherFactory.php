<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ni' => $this->faker->unique()->randomNumber(8),
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'pob' => $this->faker->city.", ".$this->faker->date('Y-m-d'),
            'password' => Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail,
            'subject_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
