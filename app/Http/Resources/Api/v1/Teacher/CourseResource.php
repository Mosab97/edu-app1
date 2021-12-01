<?php

namespace App\Http\Resources\Api\v1\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
