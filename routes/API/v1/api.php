<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthControllerV1;


// Authenticated Routes
//Route::middleware(['auth:sanctum'])->group(function () {
//
//    // Routes for managing resources related to a single user
//    Route::prefix('users/{user}')->scopeBindings()->group(function () {
//        Route::apiResource('mangas', MangaController::class);
//        Route::apiResource('animes', AnimeController::class);
//        Route::apiResource('watchlists', WatchlistController::class)->except('update');
//        Route::apiResource('favourites', FavouriteController::class)
//            ->except('update');
//        Route::apiResource('genres', PublicGenreController::class);
//
//        // Routes for managing resources related to a specific anime
//        Route::prefix('animes/{anime}')->scopeBindings()->group(function () {
//            Route::apiResource('seasons', SeasonController::class);
//            Route::apiResource('movies', MovieController::class);
//            Route::apiResource('playlists', PlaylistController::class);
//            Route::apiResource('genres',AnimeSingleGenreController::class)->except(['update','show']);
//        });
//
//        //Route for managing resources related to a specific manga
//        Route::prefix('mangas/{manga}')->scopeBindings()->group(function () {
//            Route::apiResource('readlists', ReadlistController::class);
//            Route::apiResource('genres',MangaSingleGenreController::class)->except(['update','show']);
//        });
//    });
//
//    // Routes for managing public resource
//    Route::apiResource('genres', PublicGenreController::class)->except(['store','update','destroy']);
//
//    // Authentication-related Routes
//    Route::prefix('auth')->name('auth.')->group(function () {
//        Route::post('logout', [AuthControllerV1::class, 'logout'])->name('logout');
//    });
//});

// Public Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthControllerV1::class, 'login'])
        ->name('login');
    Route::post('register', [AuthControllerV1::class, 'register'])
        ->name('register');
});
