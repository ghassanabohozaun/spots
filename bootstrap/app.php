<?php

use App\Http\Middleware\SetLangMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // ->prefix('dashboard')
            // ->name('dashboard')

            // web
            Route::middleware('web')->group(base_path('routes/dashboard.php'));

            // child
            Route::middleware('web')->group(base_path('routes/child.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // redirect if not auth
        $middleware->redirectGuestsTo(function () {
            if (request()->is('*/dashboard/*')) {
                return route('dashboard.get.login');
            } elseif (request()->is('*/child/*')) {
                return route('child.get.login');
            } else {
                return route('home');
            }
        });

        // redirect if auth
        $middleware->redirectUsersTo(function () {
            if (Auth::guard('admin')->check()) {
                return route('dashboard.index');
            } elseif (Auth::guard('child')->check()) {
                return route('child.children.show', child()->user()->id);
            } else {
                return route('home');
            }
        });

        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
            'PDF' => Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::class,

            //'setLanguage' => SetLangMiddleware::class,
        ]);

        $middleware->api(prepend: [SetLangMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
