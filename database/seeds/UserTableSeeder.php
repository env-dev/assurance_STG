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
        $user = App\User::create([
            'name' => 'stg',
            'username' => 'Abdel',
            'email' => 'abdel@stg.org',
            'password' => bcrypt('123456'),
        ]);

        $user->attachRole(1);
    }
}
