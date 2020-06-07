<?php

namespace App\Models\ACL;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name','description'];
    
    /*
     * Get permissions
     */
    public function permissions() 
    {
        return $this->belongsToMany(Permission::class);
    }
    
    /*
     * Permission not linked with this profile
     */
    public function permissionsAvailable($filter = null) 
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })->where(function($queryFilter) use($filter){
            if($filter)
            $queryFilter->where('permissions.name','like',"%{$filter}%");
        })->paginate();
        
        return $permissions;
    }
    
    /*
     * Get plans
     */
    public function plans() 
    {
        return $this->belongsToMany(Plan::class);
    }
}
