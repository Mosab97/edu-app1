<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    protected $guarded  = [];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }

}
