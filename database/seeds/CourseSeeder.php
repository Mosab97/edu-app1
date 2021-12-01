<?php

use Illuminate\Database\Seeder;


class CourseSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Course::class, 3)->create()->each(function ($course) {
            factory(\App\Models\Instruction::class, 3)->create(['course_id' => $course->id]);
            factory(\App\Models\Question::class, 3)->create(['course_id' => $course->id])->each(function ($question) {
                factory(\App\Models\Answer::class, 3)->create(['question_id' => $question->id]);
                $question->answers()->inRandomOrder()->first()->update(['is_right_answer' => true]);
            });
        });
    }

}

