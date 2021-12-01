<?php

namespace App\Http\Controllers\Api\v1\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Teacher\MeetingResource;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    private $model;

    public function __construct(Meeting $meeting)
    {
        $this->model = $meeting;
    }
    public function meetings(Request $request)
    {
//        $request->validate(['group_id' => 'sometimes|exists:groups,id']);
        $date = $request->get('date', false);
        $group_id = $request->get('group_id', false);
        $items = $this->model->query()
            ->when($date,function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->when($group_id,function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            })->get();
        return apiSuccess(MeetingResource::collection($items));

    }
}
