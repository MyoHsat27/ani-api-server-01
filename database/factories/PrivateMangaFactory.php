<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PrivateManga;

/**
 * @extends Factory<PrivateManga>
 */
class PrivateMangaFactory extends Factory
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
            'chapter'           => $this->faker->randomFloat(2, 0, 5),
            'manga_type_id'     => $this->faker->randomElement([1, 2, 3]),
            'release_status_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'user_id'           => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
