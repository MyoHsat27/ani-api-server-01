<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Watchlist;

/**
 * @extends Factory<Watchlist>
 */
class WatchlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'slug'        => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'description' => $this->faker->realText(),
            'user_id'     => $this->faker->numberBetween(1, 5),
        ];
    }
}
