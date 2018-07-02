<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'walid@stg.org',
            'password' => bcrypt('123456'),
        ]);

        $agence = App\User::create([
            'name' => 'Agence',
            'username' => 'agence',
            'email' => 'agence@stg.org',
            'password' => bcrypt('123456'),
        ]);

        $aon = App\User::create([
            'name' => 'AON',
            'username' => 'aon',
            'email' => 'aon@stg.org',
            'password' => bcrypt('123456'),
        ]);

        $admin->attachRole(5);
        $agence->attachRole(6);
        $aon->attachRole(7);
    }
}
