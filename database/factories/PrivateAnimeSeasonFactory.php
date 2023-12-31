<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrivateAnimeSeason;
use Illuminate\Support\Str;

/**
 * @extends Factory<PrivateAnimeSeason>
 */
class PrivateAnimeSeasonFactory extends Factory
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
            'episode'     => $this->faker->randomNumber(),
            'private_anime_id'    => $this->faker->numberBetween(1, 10),
            'release_status_id'   => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
