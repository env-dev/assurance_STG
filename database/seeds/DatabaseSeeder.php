<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandTableSeeder::class);
        $this->call(BrandModelTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(SmartphonesTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(AgencyTableSeeder::class);
        $this->call(SmartphonesTableSeeder::class);
        $this->call(RegistrationTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
