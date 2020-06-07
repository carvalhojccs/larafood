<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $role, $user;
    
    public function __construct(Role $role, User $user) 
    {
        $this->role = $role;
        $this->user = $user;
        
        $this->middleware(['can:users']);
    }
    
    public function roles($user_id) 
    {
        $user = $this->user->find($user_id);
        
        if($user):
            $roles = $user->roles()->paginate();
            return view('admin.pages.users.roles.roles', compact('user','roles'))->withSuccess('m');
        else:
            return redirect()->back();
        endif;
    }
    
    public function users($role_id) 
    {
        $role = $this->role->find($role_id);
        
        if($role):
            $users = $role->users()->paginate();
            return view('admin.pages.roles.users.users', compact('users','role'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function rolesAvailable(Request $request, $user_id) 
    {
        if($user = $this->user->find($user_id)):
            $filters = $request->except('_token');
            $roles = $user->rolesAvailable($request->filter);
            
            return view('admin.pages.users.roles.available', compact('user','roles','filters'));
        else:
            return redirect()->back();
        endif;
    }
    
     public function attachRolesUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        if (!$request->roles || count($request->roles) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }

    public function detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }
}
