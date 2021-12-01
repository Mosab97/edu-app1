<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckIsStudent
{

    public function handle($request, Closure $next)
    {
        $user = apiUser();
        if (isset($user) && ($user->user_type == User::user_type['STUDENT'])) return $next($request);
        return apiError(api('you have no permission'));

    }
}
