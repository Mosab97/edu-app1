<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(StandardSeeder::class);
        $this->call(CategoryActivitySeeder::class);
//        $this->call(ActivitySeeder::class);
        $this->call(ManagerTableSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(AgeSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ISeedOauthPersonalAccessClientsTableSeeder::class);
        $this->call(ISeedOauthClientsTableSeeder::class);
        $this->call(UserRateMessageSeeder::class);

    }
}
