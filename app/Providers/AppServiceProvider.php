<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

    public function boot()
    {
        Gate::define('admin-access', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('moderator-access', function ($user) {
            return in_array($user->role, ['admin', 'moderator']);
        });
        Gate::define('user-access', function ($user) {
            return $user->role === 'user';
        });
    }
}
