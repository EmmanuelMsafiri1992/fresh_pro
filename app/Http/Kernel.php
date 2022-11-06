<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LanguageManager::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        // My auth middlewares
        'superadmin.auth'=>\App\Http\Middleware\AuthenticateSuperAdmin::class,
        'admin.auth' => \App\Http\Middleware\AuthenticateAdmin::class,
        'wholeseller.auth' => \App\Http\Middleware\AuthenticateWholeseller::class,
        'retailer.auth' => \App\Http\Middleware\AuthenticateRetailer::class,
        'shopkeeper.auth' => \App\Http\Middleware\AuthenticateShopkeeper::class,
        'customer.auth' => \App\Http\Middleware\AuthenticateCustomer::class,
        // End of my auth middlewares
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // My gaust middlewares
        'superadmin.guest' => \App\Http\Middleware\RedirectIfAuthenticatedSuperAdmin::class,
        'admin.guest' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
        'wholeseller.guest' => \App\Http\Middleware\RedirectIfAuthenticatedWholeseller::class,
        'retailer.guest' => \App\Http\Middleware\RedirectIfAuthenticatedRetailer::class,
        'shopkeeper.guest' => \App\Http\Middleware\RedirectIfAuthenticatedShopkeeper::class,
        'customer.guest' => \App\Http\Middleware\RedirectIfAuthenticatedCustomer::class,
        // End of my gaust middlewares
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'isVerified' => \App\Http\Middleware\IsVerified::class,
        'notVerified' => \App\Http\Middleware\NotVerified::class,
    ];
}