<?php

namespace App\Http\Resources\Api\v1\Teacher;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $user = apiUser();
        $response = [
            'id' => $this->id,
            'unread_messages' => isset($user) ? (optional($user->un_read_messages()->where(['group_id' => $this->id])->first())->number ?? 0) : 0,
            'name' => $this->name,
            'video' => $this->video,
            'image' => $this->image,
            'price' => $this->price,
            'students_number_max' => $this->students_number_max,
            'number_of_live_lessons' => $this->number_of_live_lessons,
            'number_of_exercises_and_games' => $this->number_of_exercises_and_games,
            'course_date_and_time' => $this->course_date_and_time,
            'what_will_i_learn' => $this->what_will_i_learn,
            'number_of_joined_students' => $this->students->count(),
            'teacher' => new ProfileResource($this->teacher),
            'course' => new CourseResource($this->course),
            'level' => new LevelResource($this->level),
            'age' => new AgeResource($this->age),
            'gender' => gender($this->gender),
            'student_images' => optional(optional(optional($this->students)->pluck('student'))->pluck('image'))->all(),
            'lessons' => LessonNamesResource::collection($this->lessons),
            'advantages' => AdvantageResource::collection($this->advantages),
        ];

        return $response;
    }
}
