<?php

namespace App\Http\Controllers\Api\v1\Guest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Student\GroupResource;
use App\Models\Course;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function groups(Request $request)
    {
        if (isset($request->course_id)) {
            $course = Course::query()->with(['groups'])->find($request->course_id);
            if (!isset($course)) return apiError('Wrong Course Id');
            return apiSuccess(GroupResource::collection($course->groups));
        } else {
                $groups = Group::paginate($this->perPage);
            return apiSuccess([
                'items' => GroupResource::collection($groups->items()),
                'paginate' => paginate($groups),
            ]);
        }
    }

    public function group(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        if (!isset($group)) return apiError('Wrong Group Id');
        return apiSuccess(new GroupResource($group));
    }
}
