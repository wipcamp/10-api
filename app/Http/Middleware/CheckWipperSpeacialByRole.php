<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Http\Middleware\CheckRole;

class CheckWipperSpeacialByRole
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
        $role = 'camp_staffs_speacials';
        $user = JWTAuth::parseToken()->toUser()->toArray();
        $checkRole = new CheckRole;
        return $checkRole->dynamicCheckRole($user, $role, $next);
    }
}
