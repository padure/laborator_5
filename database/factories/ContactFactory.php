<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nume' => fake()->name,
            'telefon' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'adresa' => Str::random(10)
        ];
    }
}
