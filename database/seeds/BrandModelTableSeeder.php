<?php

use Illuminate\Database\Seeder;

class BrandModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++){
            App\BrandModel::create([
                'name' => 'X1',
                'price_ttc' => 2000.00,
                'brand_id' => 1]);
        }
    }
}
