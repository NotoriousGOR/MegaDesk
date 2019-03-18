<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Defining Admin users
        Gate::define('administrator', function ($user) {
        if($user->authLvl == 1)
            {
                return true;
            }
            return false;
        });

        // Defining Call Center Users
        Gate::define('callcenter', function ($user) {
        if($user->authLvl == 2)
            {
                return true;
            }
            return false;
        });

        // Defining Technician users
        Gate::define('technician', function ($user) {
        if($user->authLvl == 3)
            {
                return true;
            }
            return false;
        });

    }
}
