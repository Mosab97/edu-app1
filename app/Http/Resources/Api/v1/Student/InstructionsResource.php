<?php

namespace App\Http\Resources\Api\v1\Student;

use App\Http\Resources\Api\v1\General\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructionsResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'details' => $this->details,
        ];
        return $response;
    }
}
