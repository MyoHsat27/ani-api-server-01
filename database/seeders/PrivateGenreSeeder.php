<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateGenre;

class PrivateGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateGenre::factory(10)->create();
    }
}
