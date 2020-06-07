<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable = ['name', 'description'];


    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * Permission not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
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
