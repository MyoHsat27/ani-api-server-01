<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Http\Middleware\ApiVersionMiddleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\ValidateSignature;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Auth\Middleware\RequirePassword;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Http\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Http\Middleware\HandleCors;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\CheckPrivateUserRoute;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            SubstituteBindings::class,
            ApiVersionMiddleware::class,
            ThrottleRequests::class.":api",
            CheckPrivateUserRoute::class
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth'             => Authenticate::class,
        'auth.basic'       => AuthenticateWithBasicAuth::class,
        'auth.session'     => AuthenticateSession::class,
        'cache.headers'    => SetCacheHeaders::class,
        'can'              => Authorize::class,
        'guest'            => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'precognitive'     => HandlePrecognitiveRequests::class,
        'signed'           => ValidateSignature::class,
        'throttle'         => ThrottleRequests::class,
        'verified'         => EnsureEmailIsVerified::class,
        'check.private.user' => CheckPrivateUserRoute::class
    ];
}
