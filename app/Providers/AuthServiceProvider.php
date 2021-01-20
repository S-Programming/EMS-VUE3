<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\CheckinHistory;
use App\Policies\CheckinHistoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
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
       /* Gate::define('isAdmin', function($user) {
            return $user->roles()->first()->name == 'Admin';
         });
        
         //define a author user role 
         Gate::define('isDeveloper', function($user) {
             return $user->roles()->name == 'Developer';
         });*/
       
        
        //
    }
}
