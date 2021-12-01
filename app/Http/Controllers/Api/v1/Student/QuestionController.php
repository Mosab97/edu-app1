<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Student\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function questions(Request $request, $course_id)
    {
        $questions = Question::query()->with(['course', 'answers'])->where('course_id', $course_id)->get();
//        $course = Course::with(['questions', 'questions.answers'])->find($course_id);
//        if (!isset($course)) return apiError('Wrong Course Id');
        return apiSuccess(QuestionResource::collection($questions));
    }

    public function check_level(Request $request)
    {
        if (!isset($request->questions)) return apiError('Questions Array is required');
        if (!is_array($request->questions)) return apiError('Questions must be an Array');
        return apiSuccess(Question::CheckLevel(Question::totalPoints($request->questions)));
    }
}
