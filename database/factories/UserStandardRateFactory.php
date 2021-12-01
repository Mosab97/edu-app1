<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserStandardRate;
use Faker\Generator as Faker;

$factory->define(UserStandardRate::class, function (Faker $faker) {
    return [
        'standard_id' => \App\Models\Standard::teacher()->inRandomOrder()->first()->id,
        'rate' => $faker->numberBetween(1, 5),

    ];
});
