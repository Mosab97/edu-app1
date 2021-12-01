<?php

namespace App\Http\Resources\Api\v1\General;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRateMessageResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'message' => $this->message,
            'avg' => $this->avg,
            'standard_rates' => UserRateStandardResource::collection($this->standard_rates),
        ];
        return $response;
    }
}
