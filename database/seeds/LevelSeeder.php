<?php

use Illuminate\Database\Seeder;
use \App\Models\User;


class LevelSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Level::class,3)->create()->each(function ($level){
            if ($level->id == 1) $level->update(['points'  => 1]);
        });
    }

}

