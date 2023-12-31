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
use App\Models\WatchStatus;
use App\Models\FavouriteLevel;

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

        // Default Release Status Types
        $releaseStatusTypes = ['on-going', 'coming-soon', 'finished', 'dropped', 'hiatus'];
        foreach ($releaseStatusTypes as $type) {
            ReleaseStatus::factory()->create([
                'type' => $type,
            ]);
        }

        // Default Watch Status Types
        $watchStatusTypes = ['currently', 'completed', 'dropped', 'on-hold', 'plan-to-watch'];
        foreach ($watchStatusTypes as $type) {
            WatchStatus::factory()->create([
                'status' => $type,
            ]);
        }

        // Default Favourite Levels
        $favouriteLevels = ['trash', 'bad', 'normal', 'good', 'best', 'goat'];
        foreach ($favouriteLevels as $level) {
            FavouriteLevel::factory()->create([
                'level' => $level,
            ]);
        }


        $this->call([
            UserSeeder::class,
            PrivateMangaSeeder::class,
            PrivateAnimeSeeder::class,
            PrivateGenreSeeder::class,
            PrivateAnimeSeasonSeeder::class,
            PrivateAnimeMovieSeeder::class,
            PrivateAnimeWatchStatusSeeder::class,
            PrivateMangaReadStatusSeeder::class,
            ReadlistSeeder::class,
            WatchlistSeeder::class,
        ]);
    }
}
