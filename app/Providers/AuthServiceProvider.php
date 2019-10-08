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
        'App\Job' => 'App\Policies\JobPolicy',
        'App\Panel' => 'App\Policies\PanelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
          if ($user->id == 1) return true; // This is SuperAdmin ID
        });
    }
}
