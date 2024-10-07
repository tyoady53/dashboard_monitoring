<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\MasterCustomer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            // 'id' => '1',
            'customer_id'   => 'WYN',
            'customer_name' => 'Wynacom',
            'is_show'       => '1'
        ]);
    }
}
