<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SmartphonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++){
            App\Smartphone::create([
                'imei' => '221544478745'.$i,
                'brand_model_id' => $i
            ]);
        }
    }
}
