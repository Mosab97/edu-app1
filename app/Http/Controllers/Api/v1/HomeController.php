<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\General\ActivityResource;
use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\GroupStudentProfileResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\StandardResource;
use App\Http\Resources\Api\v1\Teacher\GroupStudentResource;
use App\Models\Activity;
use App\Models\Age;
use App\Models\ContactUs;
use App\Models\Group;
use App\Models\Level;
use App\Models\Manager;
use App\Models\Standard;
use App\Models\User;
use App\Notifications\ContactUsNotification;
use App\Rules\EmailRule;
use App\Rules\StartWith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function standards(Request $request, $standard_type)
    {
        return apiSuccess(StandardResource::collection(Standard::where(['type' => $standard_type])->get()));
    }

    public function group_students(Request $request, $group_id)
    {
        $name = $request->get('name', false);
        $group = Group::with(['students' => function ($query) use ($name) {
//            dd($name);
            $query->when($name, function ($query2) use ($name) {
                $query2->whereHas('student', function ($query3) use ($name) {
                    $query3->where('name', 'like', "%$name%");
                });
            });
        }])->findOrFail($group_id);
//        dd($group);
        $students = $group->students->pluck('student')->map(function ($item) use ($group) {
            $item['group_name'] = $group->name;
            return $item;
        });
        return apiSuccess(GroupStudentResource::collection($students));
    }

    public function group_student(Request $request, $group_id, $student_id)
    {
        $student = User::query()->studentType()->whereHas('student_groups', function ($query) use ($group_id, $student_id) {
            $query->where(['group_id' => $group_id, 'student_id' => $student_id]);
        })->findOrFail($student_id);
        return apiSuccess(new GroupStudentProfileResource($student));
    }

    public function settings()
    {
        return apiSuccess([
            'test' => 'sdfdsf'
        ]);
    }

    public function ages()
    {
        return apiSuccess(AgeResource::collection(Age::get()));
    }

    public function levels()
    {
        return apiSuccess(LevelResource::collection(Level::get()));
    }

    public function activities(Request $request)
    {
        return apiSuccess(ActivityResource::collection(Activity::get()));
    }

    public function contactUs(Request $request)
    {
        $user = apiUser();
        $newArr = [];
        $validations = [
            'title' => 'required|min:3|max:100',
            'message' => 'required|min:3|max:200',
        ];
        if (!isset($user)) $newArr = array_merge($validations, [
            'name' => 'required|max:250',
            'mobile' => ['required', new StartWith('+')],
            'email' => ['nullable', 'email', 'max:50', new EmailRule()],
        ]);
        $request->validate($newArr);

        $contact = ContactUs::create([
            'name' => $request->name,
            'title' => $request->title,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'email' => $request->email,
            'user_id' => optional($user)->id,
        ]);
        Notification::send(Manager::query()->get(), new ContactUsNotification($contact));
        return apiSuccess(null, api('Message Sent Successfully'));
    }

}
