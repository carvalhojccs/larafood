<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Models\ACL\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $permission, $profile;
    
    public function __construct(Permission $permission, Profile $profile) 
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }
    
    //lista todas as permissões de um determinado   perfil
    public function index($profileId) 
    {
        $profile = $this->profile->find($profileId);
        
        if($profile):
            $permissions = $profile->permissions()->paginate();
            return view('admin.acl.profiles.permissions.index', compact('profile','permissions'));
        else:
            redirect()->back();
        endif;
    }
    
    public function permissionsAvailable(Request $request, $profileId) 
    {
        $profile = $this->profile->find($profileId);
        
        if($profile):
            $filters = $request->except('_token');
            
            $permissions = $profile->permissionsAvailable($request->filter);
            return view('admin.acl.profiles.permissions.available', compact('profile','permissions','filters'));
        else:
            redirect()->back();
        endif;
    }
    
    public function attachPermissionsProfile(Request $request, $profileId) 
    {
        $profile = $this->profile->find($profileId);
        
        if($profile):
            
            if(!$request->permissions || count($request->permissions) == 0):
                return redirect()->back()->with('info', 'Selecione pelo menos uma permissão');
            else:
                $profile->permissions()->attach($request->permissions);
                return redirect()->route('profile.permissions', $profile->id);    
            endif;
        else:
            redirect()->back();
        endif;
    }
    
    public function detachPermissionProfile($profileId, $permissionId) 
    {
        $profile = $this->profile->find($profileId);
        $permission = $this->permission->find($permissionId);
        
        if($profile || $permission):
            $profile->permissions()->detach($permission);
            return redirect()->route('profile.permissions', $profile->id);
            else:
                return redirect()->back();
        endif;
    }
    
    public function profiles($permissionId) 
    {
        if($permission = $this->permission->find($permissionId)):
            $profiles = $permission->profiles()->paginate();
        
            
            return view('admin.acl.permissions.profiles.profiles', compact('permission', 'profiles'));
        endif;
            
        
    }
}
