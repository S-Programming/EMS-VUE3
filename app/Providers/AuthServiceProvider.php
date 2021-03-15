<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\CheckinHistory;
use App\Models\User;
use App\Http\Enums\RoleUser;
use App\Policies\CheckinHistoryPolicy;
use App\Http\Traits\AuthUser;

class AuthServiceProvider extends ServiceProvider
{
    use AuthUser;
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        CheckinHistory::class => CheckinHistoryPolicy::class,
        //CheckinHistory::class => CheckinHistoryPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //  Gate::define('isAdmin', function($user) {
        //     return $user->roles()->first()->name == 'Admin';
        //  });

        //define a author user role
        // Gate::define('isDeveloper', function ($user) {
        //     return $user->roles()->name == 'Developer';
        // });


        Gate::define('isSuperAdmin', function ($user) {
            return $this->isSuperAdminRole();
        });
        Gate::define('isAdmin', function ($user) {
            return $this->isAdminRole();
        });
        Gate::define('isEngagementManager', function ($user) {
            return $this->isEngagementManagerRole();
        });
        Gate::define('isProjectManager', function ($user) {
            return $this->isProjectManagerRole();
        });
        Gate::define('isHumanResourceManager', function ($user) {
            return $this->isHumanResourceManagerRole();
        });
        // Gate::define('isAdmin', function ($user) {
        //     return $this->isAdminRole();
        // });
    }
}
