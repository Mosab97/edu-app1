<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckIsActive
{

    public function handle($request, Closure $next)
    {
        $user = apiUser();
        if ($user->status != User::user_status['Accepted']) return apiError(api("The Account Status is {$user->status}"), 401);
        return $next($request);
    }
}
