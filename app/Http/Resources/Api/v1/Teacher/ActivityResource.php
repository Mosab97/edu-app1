<?php

namespace App\Http\Resources\Api\v1\Teacher;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new CategoryActivityResource($this->category),
            'url' => $this->url,
            'group_name' => optional($this->group)->name,
//            'group' => new GroupResource($this->group),
        ];

        return $response;
    }
}
