<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Band>
 */
class BandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = ucwords(fake()->words(2, true));
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'origin' => fake()->city(),
            'genre' => fake()->randomElement(['Heavy Metal', 'Black Metal', 'Death Metal', 'Hardcore', 'Punk Rock', 'Thrash Metal']),
            'bio' => fake()->realText(200),
        ];
    }
}