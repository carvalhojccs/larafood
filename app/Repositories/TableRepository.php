<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Description of TableRepository
 *
 * @author carvalhojccs
 */
class TableRepository implements TableRepositoryInterface
{
    protected $table;
    
    public function __construct() 
    {
        $this->table = 'tables';
    }
    
     public function getTableByUuid(string $uuid)
    {
        return DB::table($this->table)
                    ->where('uuid', $uuid)
                    ->first();
    }

    public function getTablesByTenantId(int $tenantId) 
    {
        return DB::table($this->table)
                ->where('tenant_id', $tenantId)
                ->get();
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('tables.*')
            ->get();
    }

}
