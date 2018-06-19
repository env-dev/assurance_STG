<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Brand::class, 5)->create()->each(function($brand) {
        //     $brand->brandModel()->save(
        //         factory(App\BrandModel::class)->create()->each(function($model){
        //             $model->smartphone()->save(
        //                 factory(App\Smartphone::class)->make()
        //             );
        //         })
        //     );
        // });
        App\Brand::create(['name' => 'STG']);
    }
}
