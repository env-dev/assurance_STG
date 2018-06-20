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
        // $this->call(BrandTableSeeder::class);
        // $this->call(BrandModelTableSeeder::class);
        $this->call(CityTableSeeder::class);
        // $this->call('ClientTableSeeder');
        // $this->call('RegistrationTableSeeder');
        // $this->call('SmartphonesTableSeeder');
    }
}
