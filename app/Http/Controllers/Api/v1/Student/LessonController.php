<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\General\ProfileResource;
use App\Http\Resources\Api\v1\Teacher\CourseResource;
use App\Http\Resources\Api\v1\Teacher\GroupResource;
use App\Http\Resources\Api\v1\Teacher\GroupStudentResource;
use App\Http\Resources\Api\v1\Teacher\LessonResource;
use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $model;

    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    public function index(Request $request, $group_id)
    {
        $lessons = $this->model->query()->where(['group_id' => $group_id])->get();
        return apiSuccess(LessonResource::collection($lessons));
    }

}
