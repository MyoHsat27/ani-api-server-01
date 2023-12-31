<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrivateAnime;
use Illuminate\Support\Str;

/**
 * @extends Factory<PrivateAnime>
 */
class PrivateAnimeFactory extends Factory
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
            'release_status_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'user_id'           => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
