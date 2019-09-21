<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemAdmin = App\User::create([
            'name' => 'System Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('secret'),
        ]);
        $systemAdmin->attachRole(1);
    }
}
