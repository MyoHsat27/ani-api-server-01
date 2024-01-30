<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateAnimeWatchStatus;

class PrivateAnimeWatchStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivateAnimeWatchStatus::factory(1)->create();
    }
}
