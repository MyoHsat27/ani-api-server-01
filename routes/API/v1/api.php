<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthControllerV1;
use App\Http\Controllers\API\v1\PrivateAnimeController;
use App\Http\Controllers\API\v1\PrivateAnimeMovieController;
use App\Http\Controllers\API\v1\PrivateAnimeSeasonController;
use App\Http\Controllers\API\v1\PrivateGenreController;
use App\Http\Controllers\API\v1\PrivateMangaController;
use App\Http\Controllers\API\v1\WatchlistController;
use App\Http\Controllers\API\v1\ReadlistController;
use App\Http\Controllers\API\v1\PrivateAnimeWatchlistController;
use App\Http\Controllers\API\v1\PrivateMangaReadlistController;
use App\Http\Controllers\API\v1\PrivateAnimeWatchStatusController;
use App\Http\Controllers\API\v1\PrivateMangaReadStatusController;


// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {

    // Routes for managing resources related to a single user
    Route::prefix('users/{user}')->scopeBindings()->group(function () {
        Route::apiResource('private-mangas', PrivateMangaController::class);
        Route::apiResource('private-genres', PrivateGenreController::class);
        Route::apiResource('readlists', ReadlistController::class);
        Route::apiResource('watchlists', WatchlistController::class);
        Route::apiResource('private-animes', PrivateAnimeController::class);

        // Routes for managing resources related to a specific private-anime
        Route::prefix('private-animes/{private_anime}')->name('private-animes.')->scopeBindings()
            ->group(function () {
                Route::apiResource('private-anime-seasons', PrivateAnimeSeasonController::class);
                Route::apiResource('private-anime-movies', PrivateAnimeMovieController::class);
                Route::apiResource('watch-statuses', PrivateAnimeWatchStatusController::class)
                    ->only(['store', 'show', 'destroy']);
            });

        //Route for managing resources related to a specific private-manga
        Route::prefix('private-mangas/{private_manga}')->name('private-mangas.')->scopeBindings()
            ->group(function () {
                Route::apiResource('read-statuses', PrivateMangaReadStatusController::class)
                    ->only(['store', 'show', 'destroy']);
            });

        //Route for managing resources related to a specific readlist
        Route::prefix('readlists/{readlist}')->scopeBindings()->group(function () {
            Route::apiResource('private-mangas', PrivateMangaReadlistController::class)->only([
                'index',
                'store',
                'destroy',
            ]);
        });

        //Route for managing resources related to a specific watchlist
        Route::prefix('watchlists/{watchlist}')->scopeBindings()->group(function () {
            Route::apiResource('private-animes', PrivateAnimeWatchlistController::class)->only([
                'index',
                'store',
                'destroy',
            ]);
        });
    });

    // Authentication-related Routes
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('logout', [AuthControllerV1::class, 'logout'])->name('logout');
    });
});

// Public Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthControllerV1::class, 'login'])
        ->name('login');
    Route::post('register', [AuthControllerV1::class, 'register'])
        ->name('register');
});
