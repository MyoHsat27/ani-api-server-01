<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\PrivateManga;
use App\Models\PrivateAnime;
use App\Policies\v1\PrivateMangaPolicy;
use App\Policies\v1\PrivateAnimePolicy;
use App\Models\PrivateAnimeMovie;
use App\Policies\v1\PrivateAnimeMoviePolicy;
use App\Models\PrivateAnimeSeason;
use App\Policies\v1\PrivateAnimeSeasonPolicy;
use App\Models\PrivateGenre;
use App\Policies\v1\PrivateGenrePolicy;
use App\Models\Watchlist;
use App\Policies\v1\WatchlistPolicy;
use App\Models\Readlist;
use App\Policies\v1\ReadlistPolicy;
use App\Models\PrivateAnimeWatchlist;
use App\Policies\v1\PrivateAnimeWatchlistPolicy;
use App\Models\PrivateMangaReadlist;
use App\Policies\v1\PrivateMangaReadlistPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        PrivateManga::class => PrivateMangaPolicy::class,
        PrivateAnime::class => PrivateAnimePolicy::class,
        PrivateGenre::class => PrivateGenrePolicy::class,
        PrivateAnimeMovie::class => PrivateAnimeMoviePolicy::class,
        PrivateAnimeSeason::class => PrivateAnimeSeasonPolicy::class,
        Watchlist::class => WatchlistPolicy::class,
        Readlist::class => ReadlistPolicy::class,
        PrivateAnimeWatchlist::class => PrivateAnimeWatchlistPolicy::class,
        PrivateMangaReadlist::class => PrivateMangaReadlistPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
