<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $guarded = [];

    public function scopeTeacher($query)
    {
        $query->where(['type' => User::user_type['TEACHER']]);
    }
    public function scopeStudent($query)
    {
        $query->where(['type' => User::user_type['STUDENT']]);
    }
}
