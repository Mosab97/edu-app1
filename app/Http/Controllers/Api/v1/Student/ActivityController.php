<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Teacher\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    private $_model;

    public function __construct(Activity $activity)
    {
        parent::__construct();
        $this->_model = $activity;
    }

    public function activates(Request $request, $group)
    {
        $user = apiUser();
        $items = $this->_model->query()->with(['category', 'group'])->whereHas('group' ,function ($query)use ($user){
            $query->whereHas('students',function ($qq)use ($user){
                $qq->where('student_id',$user->id);
            });
        })->where('group_id', $group)->get();
        return apiSuccess(ActivityResource::collection($items));
    }


}
