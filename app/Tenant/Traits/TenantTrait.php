<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTrait 
{
    protected static function boot() 
    {
        parent::boot();
     
        static::observe(TenantObserver::class);
        
        //aplica o scopo para filtar pelo tenant do usuário logado
        $tenant = static::addGlobalscope(new TenantScope);
    }
}
