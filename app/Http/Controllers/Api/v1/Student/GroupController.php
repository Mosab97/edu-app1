<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\General\ProfileResource;
use App\Http\Resources\Api\v1\Student\GroupResource;
use App\Http\Resources\Api\v1\Student\MyGroupResource;
use App\Models\Course;
use App\Models\Group;
use App\Models\Level;
use App\Models\StudentGroups;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    private $_model;

    public function __construct(Group $group)
    {
        parent::__construct();
        $this->_model = $group;
    }


    public function subscribe(Request $request, $group_id)
    {
        $student = apiUser();
        $group = Group::findOrFail($group_id);
        if ($student->student_groups()->where([
                'course_id' => $group->course_id,
                'group_id' => $group->id,
            ])->count() > 0) return apiError(api('You can not subscribe to this group more than one'));
        $student->student_groups()->create([
            'course_id' => $group->course_id,
            'group_id' => $group->id,
            'is_paid' => $request->get('is_paid', false),
        ]);
        return apiSuccess(api('Subscribe Successfully'));

    }


    public function groupsByCourse(Request $request, $course_id)
    {
        $groups = Group::query()->where('course_id', $course_id)->with(['course'])->get();
//        if (count($groups) == 0) return apiError('Wrong Course Id');
        return apiSuccess(GroupResource::collection($groups));
    }

    public function groupsByLevel(Request $request, $course_id, $level_id)
    {
        $age_id = $request->get('age_id', false);
        $groups = Group::query()->where(['course_id' => $course_id, 'level_id' => $level_id,])->when($age_id, function ($query) use ($age_id) {
            $query->where('age_id', $age_id);
        })->with(['course', 'level', 'age'])->get();
//        if (count($groups) == 0) return apiError('Wrong Course Id');
        return apiSuccess(GroupResource::collection($groups));
    }

    public function my_groups(Request $request)
    {
        $student = apiUser();
        if (!isset($student)) return apiError('Wrong Student');
        $name = $request->get('name', false);


        $groups = $this->_model->query()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', "%$name%");
            })

            //            This code will exclude the current user from the subscribed students
//            ->with(['students' => function ($query) use ($student) {
//            $query->where('student_id', '!=', $student->id);
//        }])
            ->checkStudent(apiUser())->get();
        return apiSuccess(MyGroupResource::collection($groups));
    }

    public function group(Request $request, $group_id)
    {
        $group = Group::query()->with(['lessons', 'teacher', 'course', 'level', 'age'])->find($group_id);
        if (!isset($group)) return apiError('Wrong Group Id');
        return apiSuccess(new GroupResource($group));
    }

    public function teacher_profile(Request $request, $teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        return apiSuccess(new ProfileResource($user));
    }
}
