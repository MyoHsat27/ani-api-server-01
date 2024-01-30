<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Readlist;

class ReadlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Readlist::factory(20)->create();
    }
}
