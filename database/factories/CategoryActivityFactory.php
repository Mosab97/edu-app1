<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryActivity;
use Faker\Generator as Faker;

$factory->define(CategoryActivity::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
