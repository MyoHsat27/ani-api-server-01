<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FavouriteLevel;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Favourite Levels
        $favouriteLevels = ['trash', 'bad', 'normal', 'good', 'best', 'goat'];
        foreach ($favouriteLevels as $level) {
            FavouriteLevel::factory()->create([
                'level' => $level,
            ]);
        }
    }
}
