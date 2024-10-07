<?php

namespace Database\Seeders;

use App\Models\CustomerBranch;
use App\Models\MasterCustomerBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterCustomerBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CustomerBranch::create([
            // 'id' => '1',
            'outlet_id'     => '0001',
            'customer_id'   => '1',
            'branch_name'   => 'Wynacom',
            'is_show'       => '1',
        ]);
    }
}
