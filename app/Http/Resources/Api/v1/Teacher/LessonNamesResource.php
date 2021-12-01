<?php

namespace App\Http\Resources\Api\v1\Teacher;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use App\Http\Resources\Api\v1\General\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonNamesResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $response = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $response;
    }
}
