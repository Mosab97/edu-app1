<?php

namespace App\Http\Resources\Api\v1\Student;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\ProfileResource;
use App\Http\Resources\Api\v1\Teacher\AdvantageResource;
use App\Http\Resources\Api\v1\Teacher\CourseResource;
use App\Http\Resources\Api\v1\Teacher\LessonNamesResource;
use App\Http\Resources\Api\v1\Teacher\LessonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'image' => $this->image,
            'video' => $this->video,
            'name' => $this->name,
            'price' => $this->price,
            'students_number_max' => $this->students_number_max,
            'what_will_i_learn' => $this->what_will_i_learn,
            'gender' => gender($this->gender),
            'time' => $this->time,
            'number_of_joined_students' => $this->students->count(),
            'level' => new LevelResource($this->level),
            'age' => new AgeResource($this->age),
            'lessons' => LessonNamesResource::collection($this->lessons),
            'advantages' => AdvantageResource::collection($this->advantages),





            'number_of_live_lessons' => $this->number_of_live_lessons,
            'number_of_exercises_and_games' => $this->number_of_exercises_and_games,
            'course_date_and_time' => $this->course_date_and_time,
            'teacher' => new ProfileResource($this->teacher),
            'course' => new CourseResource($this->course),
            'student_images' => optional(optional(optional($this->students)->pluck('student'))->pluck('image'))->all(),
            ];
        return $response;
    }
}
