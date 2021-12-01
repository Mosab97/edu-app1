<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Student\InstructionsResource;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function instructions(Request $request, $course_id)
    {
        $items = Instruction::query()->with(['course'])->where('course_id', $course_id)->get();
        return apiSuccess(InstructionsResource::collection($items));
    }
}
