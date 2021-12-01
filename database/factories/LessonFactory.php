<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'url' => $faker->url,
        'date' => $faker->date(),
        'from' => $faker->time(),
        'to' => $faker->time(),
    ];
});
