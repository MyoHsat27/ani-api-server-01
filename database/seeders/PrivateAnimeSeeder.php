<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateAnime;

class PrivateAnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateAnime::factory(100)->create();
    }
}
