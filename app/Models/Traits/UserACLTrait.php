<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait {
    /*
     * Retorna as permissões
     */
    public function permissions(): array 
    {        //dd($this->permissionsRole());
        //permissões do plano
        $permissionsPlan = $this->permissionsPlan();
        //permissões do cargo do usuário
        $permissionsRole = $this->permissionsRole();
        
        $permissions = [];
        
        foreach ($permissionsRole as $permission):
            if(in_array($permission, $permissionsPlan)):
                array_push($permissions, $permission);
            endif;
        endforeach;
       
        return $permissions;
    }
    
    /*
     * retorna as permissões do plano
     */
    public function permissionsPlan(): array
    {
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan    = $tenant->plan;
        
        $permissions = [];
        foreach ($plan->profiles as $profile):
            foreach ($profile->permissions as $permission):
                array_push($permissions, $permission->name);
            endforeach;
        endforeach;

        return $permissions;
    }
    
    /*
     * retorna todas as permissões do cargo do usuário
     */
    public function permissionsRole(): array 
    {
        $roles = $this->roles()->with('permissions')->get();
       
        $permissions = [];
        foreach ($roles as $role):
            foreach ($role->permissions as $permission):
                array_push($permissions, $permission->name);
            endforeach;
        endforeach;
            
        return $permissions;
    }
    
    public function hasPermission(string $permissionName): bool 
    {
        return in_array($permissionName, $this->permissions());
    }
    
    public function isAdmin(): bool 
    {
        return in_array($this->email, config('acl.admins'));
    }
    
    public function isTenant(): bool 
    {
        return in_array(!$this->email, config('acl.admins'));
    }
}
