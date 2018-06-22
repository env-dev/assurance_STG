<?php

use Illuminate\Database\Seeder;

class RegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i <= 3; $i++){
            App\Registration::create([
                'mandat_num' => str_random(10),
                'guarantee' => 100,
                'data_flow' => $faker->date('Y-m-d', 'now'),
                'total_ttc' => '2'.$i.'51',
                'smartphone_id' => $i,
                'client_id' => $i,
                'agency_id' => $i,
            ]);
        }
    }
}
