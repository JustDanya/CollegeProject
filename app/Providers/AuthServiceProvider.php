<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\User;
use App\Photos;




class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Photos::class => PhotoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-photo', function ($user, $photo) { 
        return $user->id === $photo->user_id;
    });
        Gate::define('edit-settings', function ($user, $photo) {
        return $user->id === $photo->user_id
                ? Response::allow()
                : Response::deny('You must be a the owner of this photo.');
    });
        Gate::define('create-photo', function ($user) {
        return isset($user->id);
             //   ? Response::allow()
               // : Response::deny('You must be a User.');
        });

        Gate::define('del-use', function ($user, $use) {
        return $user->id === $use->id
                ? Response::allow()
                : Response::deny('You must be a this user.');
    });    
    }
}
