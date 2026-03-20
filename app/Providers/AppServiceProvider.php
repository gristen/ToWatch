<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
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

    public function boot(): void
    {
        /*if (env('APP_ENV') === 'production' || env('APP_ENV') === 'local') {
            URL::forceScheme('https');
        }*/

        Gate::define('admin-only', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('admin-or-moder', function ($user) {
            return in_array($user->role->name, ['admin', 'moderator']);
        });

        Gate::define('any-auth', function ($user) {
            return in_array($user->role->name, ['admin', 'moder', 'user']);
        });
        /*actions*/
        Gate::define('user-action', function (User $user, string $action) {
            return $user->hasPermission($action);
        });
        /*end actions*/


        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Paginator::useBootstrapFive();
    }
}
