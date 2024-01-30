<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MangaType;

class MangaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Manga Types
        $mangaTypes = ['manga', "manhwa", "manhua"];
        foreach ($mangaTypes as $type) {
            MangaType::factory()->create([
                'type' => $type,
            ]);
        }

    }
}
