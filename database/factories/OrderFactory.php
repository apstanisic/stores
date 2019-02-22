<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Order::class, function (Faker $faker) {

    return [
        'status' => App\Status::inRandomOrder()->first()->id
    ];
});
