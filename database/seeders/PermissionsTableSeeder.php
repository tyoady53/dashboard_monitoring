<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dashboard
        Permission::create(['name' => 'dashboard.index',    'guard_name' => 'web']);

        //users
        Permission::create(['name' => 'users.index',        'guard_name' => 'web']);
        Permission::create(['name' => 'users.create',       'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit',         'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete',       'guard_name' => 'web']);

        //Customers
        Permission::create(['name' => 'customer.index',     'guard_name' => 'web']);
        Permission::create(['name' => 'customer.create',    'guard_name' => 'web']);
        Permission::create(['name' => 'customer.edit',      'guard_name' => 'web']);
        Permission::create(['name' => 'customer.delete',    'guard_name' => 'web']);

        //roles
        Permission::create(['name' => 'roles.index',     'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create',    'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit',      'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete',    'guard_name' => 'web']);

        //permissions
        Permission::create(['name' => 'permissions.index',     'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.create',    'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.edit',      'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.delete',    'guard_name' => 'web']);
    }
}
