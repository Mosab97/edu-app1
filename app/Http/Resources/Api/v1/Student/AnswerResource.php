<?php

namespace App\Http\Resources\Api\v1\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'is_right_answer' =>$this->is_right_answer,
        ];
        return $response;
    }
}
