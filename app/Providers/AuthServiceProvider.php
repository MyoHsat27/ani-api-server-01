<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeMovie;
use App\Models\PrivateAnimeSeason;
use App\Models\PrivateAnimeWatchlist;
use App\Models\PrivateAnimeWatchStatus;
use App\Models\PrivateGenre;
use App\Models\PrivateManga;
use App\Models\PrivateMangaReadlist;
use App\Models\PrivateMangaReadStatus;
use App\Models\Readlist;
use App\Models\Watchlist;
use App\Policies\v1\PrivateAnimeMoviePolicy;
use App\Policies\v1\PrivateAnimePolicy;
use App\Policies\v1\PrivateAnimeSeasonPolicy;
use App\Policies\v1\PrivateAnimeWatchlistPolicy;
use App\Policies\v1\PrivateAnimeWatchStatusPolicy;
use App\Policies\v1\PrivateGenrePolicy;
use App\Policies\v1\PrivateMangaPolicy;
use App\Policies\v1\PrivateMangaReadlistPolicy;
use App\Policies\v1\PrivateMangaReadStatusPolicy;
use App\Policies\v1\ReadlistPolicy;
use App\Policies\v1\WatchlistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
      PrivateMangaReadlist::class => PrivateMangaReadlistPolicy::class,
      PrivateAnimeWatchStatus::class => PrivateAnimeWatchStatusPolicy::class,
      PrivateMangaReadStatus::class => PrivateMangaReadStatusPolicy::class
   ];

   /**
    * Register any authentication / authorization services.
    */
   public function boot(): void
   {
      $this->registerPolicies();
   }
}
