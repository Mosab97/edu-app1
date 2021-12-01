<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'user_type' => collect([1, 2])->random(),
        'status' => collect(\App\Models\User::user_status)->random(),
        'email' => $faker->email,
        'username' => $faker->userName,
        'phone' => $faker->e164PhoneNumber,
        'whatsapp' => $faker->e164PhoneNumber,
        'gender' => collect(Gender)->random(),
        'verified' => collect([0, 1])->random(),
        'password' => \Illuminate\Support\Facades\Hash::make(PASSWORD)
    ];
});
