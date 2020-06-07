<?php

namespace App\Models;

use App\Models\ACL\Profile;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name','url','price','description'];
    
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }
    public function search($filter = null) 
    {
        $results = $this
                ->where('name','like',"%{$filter}%")
                ->orWhere('description','like',"%{$filter}%")
                ->paginate();
                
        return $results;
    }
    
    public function profilesAvailable($filter = null) 
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })->where(function($queryFilter) use($filter){
            if($filter):
                $queryFilter->where('profiles.name','like',"%{$filter}%");
            endif;
        })->paginate();
        
        return $profiles;
    }
    
    /*
     * Get profiles
     */
    public function profiles() 
    {
        return $this->belongsToMany(Profile::class);
    }
    
    /*
     * Get tenants
     */
    public function tenants() 
    {
        return $this->hasMany(Tenant::class);
    }
    
}
