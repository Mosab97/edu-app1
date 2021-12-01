<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Http\Request;

class SystemConstantsController extends Controller
{
    public function system_constants(Request $request)
    {
        return apiSuccess([
            'user_type' => \App\Models\User::user_type,
            'STUDENT_DEFAULT_PHONE' => STUDENT_DEFAULT_PHONE,
            'TEACHER_DEFAULT_PHONE' => TEACHER_DEFAULT_PHONE,
            'user_account_status' => User::user_status,
            'Rate_Standards' => User::user_type,
        ]);
    }

}
