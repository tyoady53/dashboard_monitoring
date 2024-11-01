<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\MasterPosition;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions    = Permission::orderBy('name','ASC')->get();

        // dd($permissions);
        return Inertia::render('Apps/Permissions/Index', [
            'permissions'   => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->index){
            Permission::create([
                'name'      => $request->base_name.'.index',
                'guard_name'=> 'web',
            ]);
        }

        if($request->create){
            Permission::create([
                'name'      => $request->base_name.'.create',
                'guard_name'=> 'web',
            ]);
        }

        if($request->edit){
            Permission::create([
                'name'      => $request->base_name.'.edit',
                'guard_name'=> 'web',
            ]);
        }

        if($request->delete){
            Permission::create([
                'name'      => $request->base_name.'.delete',
                'guard_name'=> 'web',
            ]);
        }
        if($request->additional_name){
            for($i = 0; $i < count($request->additional_name); $i++){
                Permission::create([
                    'name'      => $request->base_name.'.'.$request->additional_name[$i],
                    'guard_name'=> 'web',
                ]);
            }
        }

        return redirect()->route('apps.permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the resource by ID and delete it
            $permission = Permission::findOrFail($id);
            $permission->delete();

            // Optionally, you can return a success response
            return response()->json(['message' => 'Permission deleted successfully'], 200);

        } catch (\Exception $e) {
            // If an error occurs during deletion, return an error response
            return response()->json(['error' => 'Failed to delete permission'], 500);
        }
    }
}
