<?php

namespace App\Models;

use App\Traits\UploadMedia;
use Illuminate\Database\Eloquent\Model;

class GroupFile extends Model
{
    use UploadMedia;
    public const manager_route = 'group_files';

    protected $guarded = [];


    public function chatMessage()
    {
        return $this->belongsTo(ChatMessage::class,'chat_message_id');
    }
}
