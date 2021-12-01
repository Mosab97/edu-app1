<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Age extends Model
{
    protected $guarded = [];
    public const manager_route = 'age';
    public function getActionButtonsAttribute()
    {
        if (Auth::guard('manager')->check()) {
            $button = '';
            $button .= '<a href="' . route('manager.' . self::manager_route . '.edit', $this->id) . '" class="btn btn-icon btn-danger "><i class="la la-pencil"></i></a> ';
            $button .= '<button type="button" data-id="' . $this->id . '" data-toggle="modal" data-target="#deleteModel" class="deleteRecord btn btn-icon btn-danger"><i class="la la-trash"></i></button>';
            return $button;
        }
    }
}
