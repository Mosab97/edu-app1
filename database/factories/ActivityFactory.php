<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'url' => $faker->url,
        'category_id' => \App\Models\CategoryActivity::inRandomOrder()->first()->id,
    ];
});
