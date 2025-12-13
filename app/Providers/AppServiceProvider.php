<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('admin-only', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('admin-or-moder', function ($user) {
            return in_array($user->role->name, ['admin', 'moderator']);
        });



        Gate::define('any-auth', function ($user) {
            return in_array($user->role->name, ['admin', 'moder', 'user']);
        });




        /*if (env('APP_ENV') === 'production' || env('APP_ENV') === 'local') {
            URL::forceScheme('https');
        }*/
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
    }
}
