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
        // Gate::define('isAdmin', function($user){ 
        //     $roles = $user->roles->pluck('name')->toArray();
        //     dd($roles);
        //     return in_array('Admin', $roles);
        // });
        Gate::define('isAllowed', 'App\Gate\PostGate@allowed');
    }
}
