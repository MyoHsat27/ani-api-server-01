<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Set up rate limiting for the 'api' guard
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(1000)->response(function (Request $request, array $headers) {
                return response(['status' => 'error', 'message' => 'STOP CALLING ME SO FREQUENTLY'],
                    429,
                    $headers);
            });
        });

        // Route Defining
        $this->routes(function () {
            // API routes configuration
            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(base_path('routes/api.php'));

            // Web routes configuration
            Route::middleware('web')->group(base_path('routes/web.php'));
        });
    }

}
