<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'name',
        'url',
        'description',
    ];
    
    public function products() 
    {
        return $this->belongsToMany(Product::class);
    }
    
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
