<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBranch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user()->roles[0]['id']);
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
        if(str_contains($a, 'users.index')){
            if(Auth::user()->roles[0]['id'] == 1) {
                $users = User::with('has_company','has_branch','roles')->orderBy('name')->paginate(25);
            } else {
                $users = User::with('has_company','has_branch','roles')->where('customer_id',Auth::user()->customer_id)->where('customer_branch',Auth::user()->customer_branch)->orderBy('name')->paginate(25);
            }

            return Inertia::render('Apps/User/Index', [
                'users'     => $users
            ]);
        }

        return Inertia::render('Forbidden403', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->roles[0]['id'] == 1) {
            $companies  = Customer::where('is_show',1)->get();
            $roles      = Role::all();
        } else {
            $companies  = Customer::where('is_show',1)->where('id',Auth::user()->customer_id)->get();
            $roles      = Role::where('id','>',1)->get();
        }
        return Inertia::render('Apps/User/Create', [
            'companies'     => $companies,
            'roles'         => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|unique:users',
            'username'  =>  'required|unique:users',
            'password'  =>  'required|confirmed',
            'branch'    =>  'required',
            'company'   =>  'required'
        ]);

        $id = 1;
        $user = User::latest()->first();
        if($user) {
            $id = $user->id + 1;
        }

        // dd($request,$id);

        $user = User::create([
            // 'id'            => $id,
            'name'          => strtoupper($request->name),
            'email'         => $request->email,
            'password'      => md5($request->password),
            'username'      => $request->username,
            'customer_id'   => $request->company,
            'customer_branch' => $request->branch,
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('apps.user.index');
        // dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(auth()){
            $user_id = auth()->user()->id;
        }
        $a = '';
        $user = User::where('id',$user_id)->first();
        $permissions = $user->getPermissionsViaRoles();
        for ($j = 0; $j < $permissions->count(); $j++){
            if(str_contains($permissions[$j]['name'], 'edit')){
                $a .= $permissions[$j]['name'].', ';
            }
        }
        if(str_contains($a, 'users.edit')){
            $user = User::where('id',$id)->first();
            if(Auth::user()->roles[0]['id'] == 1) {
                $companies  = Customer::where('is_show',1)->get();
                $roles      = Role::all();
                $user_role  = User::with('roles')->where('id',$id)->first();
            } else {
                $companies  = Customer::where('is_show',1)->where('id',Auth::user()->customer_id)->get();
                $roles      = Role::where('id','>',1)->get();
                $user_role  = User::with('roles')->where('id',$id)->first();
            }
            $user_roles = array();
            foreach($user_role->roles as $role) {
                array_push($user_roles,['id'=>$role->id,'name'=>$role->name]);
            }
            // dd($user_roles);
            return Inertia::render('Apps/User/Edit', [
                'user'      => $user,
                'roles'     => $roles,
                'companies' => $companies,
                'user_roles'=> $user_roles,
            ]);
        }

        return Inertia::render('Forbidden403', [
        ]);
    }

    public function my_profile() {
        $id = auth()->user()->id;
        $user = User::where('id',$id)->first();
        return Inertia::render('Apps/User/MyProfile', [
            'user'     => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id',$id)->first();

        if($request->password) {
            $user->update([
                'password'      => md5($request->password)
            ]);
        }

        if($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('apps.index');
        // dd($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $branches = CustomerBranch::where('customer_id',$id)->get();
        // dd($branches,$id);
        // return response()->json([
        //     'status'    => true,
        //     'message'   => 'Monitoring Data',
        //     'data'      => $branches
        // ]);
    }

    public function get_permissions()
    {
        $array_permission = array();
        foreach (Auth::user()->getAllPermissions() as $key => $permission) {
            array_push($array_permission, $permission->name);
        }

        if(count($array_permission)) {
            $return['status']   = 200;
            $return['data']     = $array_permission;
        } else {
            $return['status']   = 500;
        }

        return response()->json(
            $return
        );
    }
}
