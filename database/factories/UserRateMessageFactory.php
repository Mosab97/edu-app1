<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserRateMessage;
use Faker\Generator as Faker;

$factory->define(UserRateMessage::class, function (Faker $faker) {
    return [
        'message' => $faker->paragraph,

    ];
});
