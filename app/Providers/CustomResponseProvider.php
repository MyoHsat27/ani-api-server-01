<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Response\CustomResponse;

class CustomResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('customResponse', function ($app) {
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
