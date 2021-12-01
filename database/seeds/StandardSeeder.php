<?php

use Illuminate\Database\Seeder;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Standard::class, 3)->create(['type' => \App\Models\User::user_type['STUDENT']]);
        factory(\App\Models\Standard::class, 3)->create(['type' => \App\Models\User::user_type['TEACHER']]);
    }
}
