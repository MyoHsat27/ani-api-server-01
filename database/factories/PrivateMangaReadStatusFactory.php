<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrivateMangaReadStatus;

/**
 * @extends Factory<PrivateMangaReadStatus>
 */
class PrivateMangaReadStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chapter'          => $this->faker->randomNumber(),
            'favourite_level_id'     => $this->faker->randomElement([1, 2, 3, 4, 5, 6]),
            'watch_status_id'  => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'private_manga_id' => $this->faker->numberBetween(1, 10),
            'user_id'          => 1,
        ];
    }
}
