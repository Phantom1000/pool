<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Entry;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access', function (User $user, $role) {
            return $user->hasRoles($role);
        });

        Gate::define('cancel', function (Entry $entry) {
            return $entry->state == 0;
        });
    }
}
