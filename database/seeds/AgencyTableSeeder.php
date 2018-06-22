<?php

use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
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
            App\Agence::create([
                'full_name' => $faker->company,
                'name' => $faker->companySuffix,
                'reference' => str_random(10),
                'address' => $faker->cityPrefix.', '.$faker->state.', '.$faker->streetAddress,
                'email' => $faker->safeEmail,
                'phone' => $faker->phoneNumber,
                'city_id' => $i
            ]);
        }
    }
}
