<?php

use Illuminate\Database\Seeder;
use \App\Models\User;


class AgeSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Age::class, 3)->create();
    }

}

