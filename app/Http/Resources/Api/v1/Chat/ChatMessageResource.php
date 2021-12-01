<?php

namespace App\Http\Resources\Api\v1\Chat;

use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    public function toArray($request)
    {
        $sender = $this->sender;
        $response = [
            'id' => $this->id,
            'message' => $this->message,
            'timestamp' => Carbon::parse($this->created_at)->format(DATE_FORMAT_FULL),
            'type' => $this->type,
            'group_id' => $this->group_id,
            'sender' => [
                'id' => optional($sender)->id,
                'name' => optional($sender)->name,
                'image' => optional($sender)->image,
            ],
        ];
        if ($this->type == ChatMessage::type['file']) $response['file'] = optional($this->file)->path;
        return $response;

    }
}
