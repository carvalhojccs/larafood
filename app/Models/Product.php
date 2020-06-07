<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'title',
        'flag',
        'price',
        'description',
        'image',
    ];
    
    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }
    
    /*
     * Search
     */
    public function search(array $data) 
    {
        $resultSearch = $this->where(function($query) use($data){
            if(isset($data['title'])):
                $query->where('title','like',"%{$data['title']}%");
            endif;
            
            if(isset($data['description'])):
                $query->where('description','like',"%{$data['description']}%");
            endif;
        })->paginate();
        
        return $resultSearch;
    }
    
    public function categoriesAvailable($filter = null) 
    {
        $categories = Category::whereNotIn('categories.id', function($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;
    }
}
