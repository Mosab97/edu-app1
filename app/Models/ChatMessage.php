<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public const type = [
        'text' => 'text',
        'file' => 'file',
    ];
    protected $guarded = [];
    public const manager_route = 'chat_messages';

    public function file()
    {
        return $this->hasOne(GroupFile::class, 'chat_message_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
