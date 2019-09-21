<?php

use Illuminate\Database\Seeder;
use App\Entrust\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'user'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'display_name' => ucwords($role),
                'description' => $role . ' role description',
            ]);
        }

    }
}
