<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create user
        $user = User::create([
            // 'id'    => '1',
            'name'              => 'Administrator',
            'email'             => 'admin@test.com',
            'password'          => bcrypt('password'),
            'customer_id'       => '1',
            'customer_branch'   => '1',
        ]);
    }
}