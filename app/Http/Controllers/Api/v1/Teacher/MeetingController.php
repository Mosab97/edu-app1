<?php

namespace App\Http\Controllers\Api\v1\Teacher;

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

    public function index(Request $request)
    {
        $request->validate(['group_id' => 'sometimes|exists:groups,id']);
        $date = $request->get('date', false);
        $group_id = $request->get('group_id', false);
        $items = $this->model->query()
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->when($group_id, function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            })->get();
        return apiSuccess(MeetingResource::collection($items));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'title' => 'sometimes|min:3|max:100',
            'date' => 'required|date_format:Y-m-d',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
//            'url' => 'required',
            'is_canceled' => 'sometimes|in:1,0',
        ]);
        return apiSuccess(new MeetingResource($this->model->create($request->all())), api('Meeting Created Successfully'));
    }

    public function update(Request $request, $meeting_id)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'title' => 'sometimes|min:3|max:100',
            'date' => 'required|date_format:d/m/Y',
            'from' => 'required|date_format:h:i',
            'to' => 'required|date_format:h:i',
//            'url' => 'required',
            'is_canceled' => 'sometimes|in:1,0',
        ]);

        $meeting = $this->model->query()
//            ->whereHas('group', function ($query) {
//            $query->where('teacher_id', apiUser()->id);
//        })
            ->findOrFail($meeting_id);
        $meeting->update($request->all());
        return apiSuccess(new MeetingResource($meeting), api('Meeting Updated Successfully'));
    }

    public function destroy(Request $request, $meeting_id)
    {
        $this->model->query()
//            ->whereHas('group', function ($query) {
//            $query->where('teacher_id', apiUser()->id);
//        })
            ->findOrFail($meeting_id)->delete();
        return apiSuccess(null, api('Meeting Deleted Successfully'));

    }
}
