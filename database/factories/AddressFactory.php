<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'street_name' => $faker->streetName,
        'building_number' => $faker->buildingNumber,
        'city' => $faker->city,
        'postal_code' => $faker->numberBetween(11000, 37999),
    ];
});