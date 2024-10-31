<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if(auth()){
            $user_id = auth()->user()->id;
        }
        $a = '';
        $user = User::where('id',$user_id)->first();
        $permissions = $user->getPermissionsViaRoles();
        for ($j = 0; $j < $permissions->count(); $j++){
            if(str_contains($permissions[$j]['name'], 'index')){
                $a .= $permissions[$j]['name'].', ';
            }
        }
        $roles = Role::when(request()->q, function($roles) {
            $roles = $roles->where('name', 'like', '%' . request()->q . '%');
        })->with('permissions')->latest()->paginate(25);

        // dd($a);
        if(str_contains($a, 'roles.index')){
            return Inertia('Apps/Roles/Index', [
                'roles' => $roles,
            ]);
        }

        return Inertia::render('Forbidden403', [
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return inertia('Apps/Roles/Create', [
            'permissions'   => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        $role = Role::create(['name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('apps.role.index');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::all();

        return inertia('Apps/Roles/Edit', [
            'role'          => $role,
            'permissions'   => $permissions
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);
        $role = Role::where('id',$id)->first();

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('apps.role.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('apps.role.index');
    }
}
