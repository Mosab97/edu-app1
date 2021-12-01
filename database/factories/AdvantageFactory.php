<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advantage;
use Faker\Generator as Faker;

$factory->define(Advantage::class, function (Faker $faker) {
    return [
        'name' => $faker->title
    ];
});
