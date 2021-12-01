<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{

    public const manager_route = 'course';

    public function getActionButtonsAttribute()
    {
        if (Auth::guard('manager')->check()) {
            $button = '';
            $button .= '<a href="' . route('manager.' . self::manager_route . '.edit', $this->id) . '" class="btn btn-icon btn-danger "><i class="la la-pencil"></i></a> ';
            $button .= '<button type="button" data-id="' . $this->id . '" data-toggle="modal" data-target="#deleteModel" class="deleteRecord btn btn-icon btn-danger"><i class="la la-trash"></i></button>';
            return $button;
        }
    }


    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getIsSubscribedAttribute()
    {
        $user = apiUser();
        $result = StudentGroups::query()->where(['student_id' => $user->id])->whereHas('group', function ($query) {
            $query->where(['course_id' => $this->id]);
        })->count();
        return $result > 0;
    }
}
