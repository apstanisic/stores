<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Product::class, function (Faker $faker) {
    return [
    	'name' => $faker->colorName,
        'description' => $faker->paragraph,
        'price' => ($faker->numberBetween(1, 100)) * 100,
        'remaining' => $faker->numberBetween(5, 200)
    ];
});