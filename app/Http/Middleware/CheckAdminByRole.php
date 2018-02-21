<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Http\Middleware\CheckRole;

class CheckAdminByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = 'sys_admin';
        $user = JWTAuth::parseToken()->toUser()->toArray();
        $checkRole = new CheckRole;
        return $checkRole->dynamicCheckRole($user, $role, $next, $request);
    }
}
