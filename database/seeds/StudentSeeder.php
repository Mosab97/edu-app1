<?php

use Illuminate\Database\Seeder;


class StudentSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\User::class, 10)->create([
            'user_type' => \App\Models\User::user_type['STUDENT'],
        ])->each(function ($student) {
            $teachersCount = \App\Models\User::query()->where('user_type', \App\Models\User::user_type['TEACHER'])->count();
            if ($student->id == ($teachersCount + 1)) {
                $student->phone = STUDENT_DEFAULT_PHONE;
                $student->verified = true;
                $student->status = \App\Models\User::user_status['Accepted'];
//                $student->update(['phone' => STUDENT_DEFAULT_PHONE, 'verified' => true, 'status' => \App\Models\User::user_status['Accepted'],
//                ]);
            }

            $course = \App\Models\Course::inRandomOrder()->first();
            $group = $course->groups()->inRandomOrder()->first();
            $student->student_groups()->create([
                'course_id' => $course->id,
                'group_id' => $group->id,
            ]);
            $student->save();
            $student->student_details()->create([
                'age_id' => \App\Models\Age::inRandomOrder()->first()->id
            ]);
        });
    }

}

