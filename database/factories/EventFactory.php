<?php

namespace Database\Factories;

use App\Models\Band;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Show ' . ucwords(fake()->words(2, true));
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'venue' => fake()->company() . ' Hall',
            'city' => fake()->city(),
            'description' => fake()->paragraphs(3, true),
            'event_time' => fake()->dateTimeBetween('+2 weeks', '+6 months'),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Event $event) {
            // Ambil 3 sampai 8 band secara acak untuk dilampirkan ke event ini
            $bands = Band::inRandomOrder()->limit(rand(3, 8))->pluck('id');
            $event->bands()->sync($bands);
        });
    }
}