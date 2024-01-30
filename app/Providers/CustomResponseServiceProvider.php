<?php

namespace App\Providers;

use App\Http\Response\CustomResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CustomResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CustomResponse::class, function (Application $app) {
           return new CustomResponse();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
