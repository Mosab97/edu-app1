<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meeting;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'url' => $faker->url,
        'date' => $faker->date(),
        'from' => $faker->time(),
        'to' => $faker->time(),
    ];
});
