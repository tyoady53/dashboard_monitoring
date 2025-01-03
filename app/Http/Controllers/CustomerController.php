<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Auth::user()->id != 1) {
        //     return Inertia::render('Forbidden403', []);
        // }

        // $customers = Customer::with('has_branch')->orderBy('customer_name')->get();
        // // if(!count($customers)) {
        // //     $customers = [];
        // // }
        // return Inertia::render('Apps/Customer/Index', [
        //     'customers'     => $customers
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = 1;
        $customer = Customer::latest()->first();
        if($customer) {
            $id = $customer->id + 1;
        }

        Customer::create([
            // 'id'            => $id,
            'customer_id'   => strtoupper($request->customer_id),
            'customer_name' => strtoupper($request->customer_name),
            'is_show'       => '1',
        ]);

        return redirect()->route('apps.customer.index');
    }

    public function store_branch(Request $request) {
        $id = 1;
        $branch = CustomerBranch::latest()->first();
        if($branch) {
            $id = $branch->id + 1;
        }

        // outlet_id : '',
        //     branch_name : '',
        CustomerBranch::create([
            // 'id'            => $id,
            'customer_id'   => strtoupper($request->customer_id),
            'outlet_id'     => strtoupper($request->outlet_id),
            'branch_name'   => strtoupper($request->branch_name),
            'is_show'       => '1',
        ]);

        return redirect()->route('apps.customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function get_branch($cust_id) {
        $branches = CustomerBranch::where('customer_id',$cust_id)->get();
        // dd($branches,$cust_id);
        return response()->json([
            'status'    => true,
            'message'   => 'Monitoring Data',
            'data'      => $branches
        ]);
    }
}
