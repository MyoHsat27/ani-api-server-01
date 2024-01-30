<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateManga;

class PrivateMangaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateManga::factory(100)->create();
    }
}
