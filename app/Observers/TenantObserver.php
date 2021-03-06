<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Tenant;

class TenantObserver
{
    /**
     * Handle the tenant "creating" event.
     *
     * @param  Tenant  $tenant
     * @return void
     */
    public function creating(Tenant $tenant)
    {
        
        $tenant->uuid = Str::uuid();
        
        //dd($tenant->uuid);
        
        $tenant->url = Str::kebab($tenant->name);
    }

    /**
     * Handle the tenant "updating" event.
     *
     * @param  Tenant  $tenant
     * @return void
     */
    public function updating(Tenant $tenant)
    {
        $tenant->url = Str::kebab($this->name);
    }
}
