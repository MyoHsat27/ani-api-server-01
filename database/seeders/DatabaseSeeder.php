<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\MangaType;
use App\Models\Status;
use App\Models\ReleaseStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test User Account
        User::factory()->create([
            'name'              => 'Tester',
            'slug'              => 'tester',
            'email'             => 'test@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('yngWIE500'),
            'remember_token'    => Str::random(10),
        ]);

        // Default Manga Types
        $mangaTypes = ['manga', "manhwa", "manhua"];
        foreach ($mangaTypes as $type) {
            MangaType::factory()->create([
                'type' => $type,
            ]);
        }

        // Default Status Types
        $statusTypes = ['on-going', 'coming-soon', 'finished', 'dropped', 'hiatus'];
        foreach ($statusTypes as $type) {
            ReleaseStatus::factory()->create([
                'type' => $type,
            ]);
        }

    }
}
