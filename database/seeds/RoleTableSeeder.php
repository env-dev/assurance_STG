<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Administrateur'
        ]);

        App\Role::create([
            'name' => 'agence',
            'display_name' => 'Agence',
            'description' => 'Agence'
        ]);

        App\Role::create([
            'name' => 'aon',
            'display_name' => 'AON',
            'description' => 'Aon'
        ]);
    }
}
