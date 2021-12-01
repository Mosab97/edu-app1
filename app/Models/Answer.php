<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_right_answer' => 'boolean'
    ];
}
