<?php

namespace App\Http\Controllers\Api\v1\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Teacher\ActivityResource;
use App\Http\Resources\Api\v1\Teacher\CategoryActivityResource;
use App\Http\Resources\Api\v1\Teacher\MeetingResource;
use App\Models\Activity;
use App\Models\CategoryActivity;
use App\Models\Group;
use App\Models\Meeting;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class ActivityController extends Controller
{
    private $model;

    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    public function index(Request $request, $group)
    {
        $items = $this->model->query()->with(['category', 'group'])->where('group_id', $group)->get();
        return apiSuccess(ActivityResource::collection($items));
    }

    public function category_activity(Request $request)
    {
        return apiSuccess(CategoryActivityResource::collection(CategoryActivity::get()));
    }

    public function store(Request $request, $group)
    {
        $group_obj = Group::find($group);
        if (!isset($group_obj)) return apiError(api('Wrong Group id'));

        $request->validate([
            'category_id' => 'required|exists:category_activities,id',
//            'group_id' => 'required|exists:groups,id',
            'name' => 'sometimes|min:3|max:100',
//            'url' => 'required',//|url
        ]);
        $data = $request->only(['category_id', 'name', 'url']);
        $data['group_id'] = $group_obj->id;
        return apiSuccess(new ActivityResource($this->model->create($data)), api('Activity Created Successfully'));
    }

    public function update(Request $request, $group, $activity)
    {

        $activity_obj = $this->model->query()->find($activity);
        if (!isset($activity_obj)) return apiError(api('Wrong $activity id'));
        $group_obj = Group::find($group);
        if (!isset($group_obj)) return apiError(api('Wrong Group id'));

        $request->validate([
            'category_id' => 'required|exists:category_activities,id',
            'name' => 'sometimes|min:3|max:100',
//            'url' => 'required',
        ]);
        $data = $request->only(['category_id', 'name', 'url']);
        $data['group_id'] = $group_obj->id;
        $activity_obj->update($data);
        return apiSuccess(new ActivityResource($activity_obj), api('Activity Updated Successfully'));
    }

    public function destroy(Request $request, $group, $activity)
    {
        $this->model->query()->where(['group_id' => $group])->findOrFail($activity)->delete();
        return apiSuccess(null, api('Activity Deleted Successfully'));
    }
}
