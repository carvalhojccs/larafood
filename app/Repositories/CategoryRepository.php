<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Description of CategoryRepository
 *
 * @author carvalhojccs
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;
    
    public function __construct() 
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid) 
    {
        return DB::table($this->table)
                ->join('tenants','tenants.id','=','categories.tenant_id')
                ->where('tenants.uuid',$uuid)
                ->select('caategories.*')
                ->get();
    }
    
    public function getCategoriesByTenantId(int $tenantId) 
    {
        return DB::table($this->table)->where('tenant_id',$tenantId)->get();
    }

    public function getCategotyByUrl(string $url) 
    {
        return DB::table($this->table)->where('url',$url)->first();
    }

}
