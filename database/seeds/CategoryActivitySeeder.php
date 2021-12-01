<?php

use Illuminate\Database\Seeder;

class CategoryActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\CategoryActivity::class, 5)->create();
    }
}
