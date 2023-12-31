<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Watchlist;

class WatchlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Watchlist::factory(20)->create();
    }
}
