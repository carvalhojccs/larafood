<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant 
{
    /*
     * recupera o id do tenant
     */
    public function getTenantIdentify() 
    {
        return auth()->user()->tenant_id;
    }
    
    /*
     * recupera um objeto de tenant
     */
    public function getTenant(): Tenant 
    {
        return auth()->user()->tenant;
    }
    
    /*
     * verifica se  usuário logado está no array de administradores do arquivo
     * config/tenant.pgp e retorna true ou false
     */
    public function insAdmin(): bool 
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}
