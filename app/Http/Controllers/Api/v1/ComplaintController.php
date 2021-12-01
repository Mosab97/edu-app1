<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function post_complaint(Request $request, $group_id)
    {
        $request->validate(['message' => 'required|min:3|max:5000']);
        $group = Group::findOrFail($group_id);
        Complaint::create([
            'group_id' => $group->id,
            'from_id' => apiUser()->id,
            'from_type' => User::user_type['STUDENT'],
            'to_id' => $group->teacher_id,
            'message' => $request->message,
        ]);
        return apiSuccess(api('Complaint Sent Successfully'));
    }

    public function teacher_post_complaint(Request $request, $group_id, $student_id)
    {
        $request->validate(['message' => 'required|min:3|max:5000']);

        $group = Group::findOrFail($group_id);
        if ($group->students()->where(['student_id' => $student_id])->count() == 0) return apiError(api('This Student is Not Group member'));
        Complaint::create([
            'group_id' => $group->id,
            'from_id' => apiUser()->id,
            'from_type' => User::user_type['TEACHER'],
            'to_id' => $student_id,
            'message' => $request->message,
        ]);
        return apiSuccess(api('Complaint Sent Successfully'));
    }
}
