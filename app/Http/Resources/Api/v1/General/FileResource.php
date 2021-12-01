<?php

namespace App\Http\Resources\Api\v1\General;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];

        $response = [
            'id' => $this->id,
            'path' => $this->path,
            'name' => $this->name,
            'extension' => $this->extension,
        ];
        return $response;
    }
}
