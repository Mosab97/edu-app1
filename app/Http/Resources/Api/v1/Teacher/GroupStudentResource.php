<?php

namespace App\Http\Resources\Api\v1\Teacher;

use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupStudentResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $response = [
            'id' => $this->id,
            'group_name' => $this->group_name,
            'student_name' => $this->name,
            'student_image' => $this->image,
        ];


        return $response;
    }
}
