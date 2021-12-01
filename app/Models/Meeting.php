<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    protected $casts = [
        'is_canceled' => 'boolean'
    ];
}
