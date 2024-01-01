<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\PrivateManga;
use App\Models\PrivateAnime;
use App\Policies\v1\PrivateMangaPolicy;
use App\Policies\v1\PrivateAnimePolicy;

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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
