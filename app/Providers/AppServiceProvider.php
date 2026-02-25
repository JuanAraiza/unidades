<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Gate;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        \Gate::define('Administradores', function ($user) {
            if ($user->tipo == '1') {
                return true;
            }
            return false;
        });

        \Gate::define('Directores', function ($user) {
            if ($user->tipo == '2') {
                return true;
            }
            return false;
        });

        \Gate::define('Gasolineras', function ($user) {
            if ($user->tipo == '3') {
                return true;
            }
            return false;
        });
        Paginator::useBootstrapFour();
    }
}
