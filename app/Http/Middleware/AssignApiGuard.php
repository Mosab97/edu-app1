<?php

namespace App\Http\Middleware;

use Closure;

class AssignApiGuard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $guard
     * @return mixed
     */
    public function handle($request, Closure $next, int $guard)
    {
        $user = apiUser();
        if (isset($user) && $user->user_type != $guard) return apiError(api('you have no permission'));
        return $next($request);
    }
}
