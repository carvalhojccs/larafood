<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use TenantTrait;

    protected $fillable = ['identify', 'description'];
    
    /*
     * Search
     */
    public function search(array $data) 
    {
        $resultSearch = $this->where(function($query) use($data){
            if(isset($data['name'])):
                $query->where('name','like',"%{$data['name']}%");
            endif;
            
            if(isset($data['description'])):
                $query->where('description','like',"%{$data['description']}%");
            endif;
        })->paginate();
        
        return $resultSearch;
    }
}
