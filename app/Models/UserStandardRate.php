<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStandardRate extends Model
{
    protected $guarded = [];

    public function user_rate_message()
    {
        return $this->belongsTo(UserRateMessage::class, 'parent_id');
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }
}
