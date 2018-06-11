<?php

use Faker\Generator as Faker;

$factory->define(App\BrandModel::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'price_ttc' => $faker->randomFloat(null, 400, 600),
        'brand_id' => $faker->randomDigit,

    ];
});
