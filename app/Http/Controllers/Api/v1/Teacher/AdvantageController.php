<?php

namespace App\Http\Controllers\Api\v1\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Teacher\AdvantageResource;
use App\Models\Advantage;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    private $model;

    public function __construct(Advantage $advantage)
    {
        $this->model = $advantage;
    }

    public function index(Request $request)
    {
        $request->validate(['group_id' => 'required|exists:groups,id']);
        $items = $this->model->query()->where(['group_id' => $request->get('group_id')])->get();
        return apiSuccess(AdvantageResource::collection($items));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|min:3|max:100'
        ]);
        return apiSuccess(new AdvantageResource($this->model->create($request->only(['group_id', 'name']))), api('Group Created Successfully'));
    }

    public function update(Request $request, $group_id)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|min:3|max:100'
        ]);

        $group = $this->model->query()
//            ->whereHas('group', function ($query) {
//            $query->where('teacher_id', apiUser()->id);
//        })
            ->findOrFail($group_id);
        $group->update($request->only(['group_id', 'name']));
        return apiSuccess(new AdvantageResource($group), api('Group Updated Successfully'));
    }

    public function destroy(Request $request, $group_id)
    {

        $this->model->query()
//            ->whereHas('group', function ($query) {
//            $query->where('teacher_id', apiUser()->id);
//        })
            ->findOrFail($group_id)->delete();
        return apiSuccess(null, api('Advantage Deleted Successfully'));

    }
}
