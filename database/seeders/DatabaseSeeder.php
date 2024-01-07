<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test User Account
        User::factory()->create([
            'username'          => 'Tester',
            'slug'              => 'tester',
            'email'             => 'test@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('yngWIE500'),
            'remember_token'    => Str::random(10),
        ]);


        $this->call([
            MangaTypeSeeder::class,
            FavouriteSeeder::class,
            ReleaseStatusSeeder::class,
            WatchStatusSeeder::class,
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
