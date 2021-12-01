<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGroups extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->studentType();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
