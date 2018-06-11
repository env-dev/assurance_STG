<?php

use Faker\Generator as Faker;

$factory->define(App\Smartphone::class, function (Faker $faker) {
    return [
        'imei' => $faker->firstname(),
        'brand_model_id' => $faker->randomDigit,
    ];
});
