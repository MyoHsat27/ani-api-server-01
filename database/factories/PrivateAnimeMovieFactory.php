<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PrivateAnimeMovie;

/**
 * @extends Factory<PrivateAnimeMovie>
 */
class PrivateAnimeMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'slug'              => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'description'       => $this->faker->realText(),
            'alt_name'          => $this->faker->name(),
            'private_anime_id'  => $this->faker->numberBetween(1, 20),
            'release_status_id' => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
