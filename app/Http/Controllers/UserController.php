<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBranch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->id != 1) {
            return Inertia::render('Forbidden403', []);
        }

        $users = User::with('has_company','has_branch')->orderBy('name')->paginate(25);
        return Inertia::render('Apps/User/Index', [
            'users'     => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Customer::where('is_show',1)->get();
        return Inertia::render('Apps/User/Create', [
            'companies'     => $companies
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
            'password'  =>  'required|confirmed',
            'branch'  =>  'required',
            'company'  =>  'required'
        ]);

        $id = 1;
        $user = User::latest()->first();
        if($user) {
            $id = $user->id + 1;
        }

        // dd($request,$id);

        User::create([
            'id'            => $id,
            'name'          => strtoupper($request->name),
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'customer_id'   => $request->company,
            'customer_branch' => $request->branch,
        ]);

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
        $user = User::where('id',$id)->first();
        // dd($user);
        return Inertia::render('Apps/User/Edit', [
            'user'     => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'password'  =>  'required|confirmed',
        ]);

        $user = User::where('id',$id)->first();

        $user->update([
            'password'      => bcrypt($request->password)
        ]);

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
}
