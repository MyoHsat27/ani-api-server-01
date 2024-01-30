<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateAnimeSeason;

class PrivateAnimeSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateAnimeSeason::factory(10)->create();
    }
}
