<?php

namespace App\Http\Resources\Api\v1\General;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRateStandardResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'standard_name' => optional($this->standard)->name,
            'rate' => $this->rate,
        ];
        return $response;
    }
}
