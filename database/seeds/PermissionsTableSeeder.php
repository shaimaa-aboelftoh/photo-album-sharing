<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'show-dashboard',
                'display_name' => 'show-dashboard',
                'description' => 'show-dashboard'
            ],

            //------------------- Start Roles
            [
                'name' => 'all-roles',
                'display_name' => 'All roles',
                'description' => 'all-roles'
            ],
            [
                'name' => 'create-role',
                'display_name' => 'Create role',
                'description' => 'create-role'
            ],
            [
                'name' => 'show-role',
                'display_name' => 'Show role',
                'description' => 'show-role'
            ],
            [
                'name' => 'edit-role',
                'display_name' => 'Edit role',
                'description' => 'edit-role'
            ],
            [
                'name' => 'delete-role',
                'display_name' => 'Delete role',
                'description' => 'delete-role'
            ],
            //------------------- End Roles

            //------------------- Start Users
            [
                'name' => 'all-admins',
                'display_name' => 'All admins',
                'description' => 'all-admins'
            ],[
                'name' => 'all-users',
                'display_name' => 'All users',
                'description' => 'all-users'
            ],
            [
                'name' => 'create-user',
                'display_name' => 'Create user',
                'description' => 'create-user'
            ],
            [
                'name' => 'show-user',
                'display_name' => 'Show user',
                'description' => 'show-user'
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit user',
                'description' => 'edit-user'
            ],
            [
                'name' => 'delete-user',
                'display_name' => 'Delete user',
                'description' => 'delete-user'
            ],
            //------------------- End Users

            // ---------------- Start Albums Permissions

            [
                'name' => 'user-albums',
                'display_name' => 'user albums',
                'description' => 'user-albums'
            ],
            [
                'name' => 'show-user-album',
                'display_name' => 'Show User album',
                'description' => 'show-user-album'
            ],
            [
                'name' => 'delete-user-album',
                'display_name' => 'Delete user album',
                'description' => 'delete-user-album'
            ],
            [
                'name' => 'delete-user-image',
                'display_name' => 'Delete user album image',
                'description' => 'delete-user-image'
            ],
            // ---------------- End Albums Permissions
        ]);
    }
}
