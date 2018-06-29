<?php

use Illuminate\Database\Seeder;

class SmartphonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i <= 5; $i++){
            App\Smartphone::create([
                'imei' => $faker->randomNumber(8),
                'imei2' => $faker->randomNumber(8),
                'sn' => $faker->randomNumber(8),
                'wifi' => $faker->randomNumber(8),
                'brand_model_id' => $i,
            ]);
        }
    }
}
