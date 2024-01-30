<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrivateGenre;
use Illuminate\Support\Str;

/**
 * @extends Factory<PrivateGenre>
 */
class PrivateGenreFactory extends Factory
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
            'user_id'     => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
