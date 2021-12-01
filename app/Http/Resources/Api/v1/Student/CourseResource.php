<?php

namespace App\Http\Resources\Api\v1\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'is_subscribed' => $this->is_subscribed,
        ];
        return $response;
    }
}
