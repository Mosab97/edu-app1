<?php

use Illuminate\Database\Seeder;


class TeacherSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\User::class, 10)->create([
            'user_type' => \App\Models\User::user_type['TEACHER'],
        ])->each(function ($teacher) {
            if ($teacher->id == 1) $teacher->update(['phone' => TEACHER_DEFAULT_PHONE, 'verified' => true, 'status' => \App\Models\User::user_status['Accepted'],
            ]);
            factory(\App\Models\Teacher::class, 1)->create(['teacher_id' => $teacher->id,]); //1 financial user id 2
            factory(\App\Models\Group::class, 3)->create([
                'teacher_id' => $teacher->id
            ])->each(function ($group) {
                factory(\App\Models\Lesson::class, 3)->create(['group_id' => $group->id]);
                factory(\App\Models\Meeting::class, 3)->create(['group_id' => $group->id]);
                factory(\App\Models\Advantage::class, 3)->create(['group_id' => $group->id]);
                factory(\App\Models\Activity::class, 5)->create(['group_id' => $group->id]);

            });
        });


    }

}

