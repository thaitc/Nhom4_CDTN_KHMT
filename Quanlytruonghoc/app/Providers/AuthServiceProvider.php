<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('super_admin', function ($user) {
            if ($user->level == "1" || $user->level == "2") {
                return true;
            }
            return false;
        });

        Gate::define('admin', function ($user) {
            if ( $user->level == "2") {
                return true;
            }
            return false;
        });
        Gate::define('users', function ($user) {
            if ( $user->level == "3") {
                return true;
            }
            return false;
        });
    }
}
