<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateMangaReadStatus;

class PrivateMangaReadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateMangaReadStatus::factory(1)->create();
    }
}
