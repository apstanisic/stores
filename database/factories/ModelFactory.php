<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Store::class, function (Faker\Generator $faker) {
    $name = $faker->company;

    return [
    	'name' => $name ?: $name = $faker->company,
        'description' => $faker->paragraph(),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
    	'name' => $faker->words(rand(1,2), true),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
    	'name' => $faker->colorName,
        'description' => $faker->paragraph,
        'price' => ($faker->numberBetween(1, 100)) * 100,
        'remaining' => $faker->numberBetween(5, 200)
    ];
});

$factory->define(App\Buyer::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
