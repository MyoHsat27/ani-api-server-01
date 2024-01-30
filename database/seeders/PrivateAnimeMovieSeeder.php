<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateAnimeMovie;

class PrivateAnimeMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateAnimeMovie::factory(100)->create();
    }
}
