<?php

use Illuminate\Database\Seeder;
use App\Entrust\Permission;
use App\Entrust\Role;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all()->pluck('id')->toArray();

        $admin = Role::find(1);
        $admin->attachPermissions($permissions);
    }
}
