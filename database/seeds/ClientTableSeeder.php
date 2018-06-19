<?php

use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i < 3; $i++){
            App\Client::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'city' => $faker->city,
                'address' => $faker->address,
                'nature' => 'Particulier',
                'type_id' => 'CIN',
                'num_id' => 'A 41526'.$i,
                'birth_date' => $faker->date('Y-m-d', 'now'),
            ]);
        }
    }
}
