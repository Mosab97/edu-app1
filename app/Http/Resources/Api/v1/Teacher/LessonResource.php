<?php

namespace App\Http\Resources\Api\v1\Teacher;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $response = [
            'id' => $this->id,
            'group_name' => optional($this->group)->name,
            'name' => $this->name,
            'date' => $this->date,
            'from' => $this->from,
            'to' => $this->to,
            'url' => $this->url,
            'done' => $this->done,

        ];

        return $response;
    }
}
