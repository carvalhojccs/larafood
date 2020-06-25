<?php

namespace App\Providers;

use App\Models\ACL\Permission;
use Illuminate\Foundation\Auth\User;
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

        //verifica se o comando está sendo rodado via console
        if($this->app->runningInConsole()) return;
        
        $permissions = Permission::all();
        
        foreach ($permissions as $permission):
            Gate::define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission->name);
            });
        endforeach;
        
        Gate::before(function (User $user){
            if($user->isAdmin()):
                return true;
            endif;
        });
    }
}
