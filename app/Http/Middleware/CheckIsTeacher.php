<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckIsTeacher
{

    public function handle($request, Closure $next)
    {
        $user = apiUser();
        if (isset($user) && $user->user_type != User::user_type['TEACHER']) return apiError(api('you have no permission'));
        return $next($request);
    }
}
