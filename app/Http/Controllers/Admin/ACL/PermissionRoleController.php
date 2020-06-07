<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $permissionRepository, $roleRepository;
    
    public function __construct(Permission $permission, Role $role) 
    {
        $this->permissionRepository = $permission;
        $this->roleRepository = $role;
        
        $this->middleware(['can:roles']);
    }
    
    public function permissions($roleId) 
    {
        $role = $this->roleRepository->find($roleId);
        
        if($role):
            $permissions = $role->permissions()->paginate();
            return view('admin.pages.roles.permissions.permissions', compact('role','permissions'));
        else:
            return redirect()->back();
        endif;
    }

    public function roles($permissionId) 
    {
        $permission = $this->permissionRepository->find($permissionId);
        
        if($permission):
            $role = $permission->roles()->paginate();
            return view('admin.pages.permissions.roles.roles', compact('permission','role'));
        else:
            return redirect()->back();
        endif;
    }

    public function permissionsAvailable(Request $request, $roleId)
    {
        if (!$role = $this->roleRepository->find($roleId)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions', 'filters'));
    }

     public function attachPermissionsRole(Request $request, $roleId)
    {
        if (!$role = $this->roleRepository->find($roleId)) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions', $role->id)->withSuccess('message');
    }

    public function detachPermissionRole($roleId, $idPermission)
    {
        $role = $this->roleRepository->find($roleId);
        $permission = $this->permissionRepository->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id)->withSuccess('message');
    }

}
