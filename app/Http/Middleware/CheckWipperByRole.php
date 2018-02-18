<?php

namespace App\Http\Middleware;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Closure;

class CheckWipperByRole
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
        $roleRepo = new RoleRepository;
        $roleId = $roleRepo->getIdByName('camp_staffs_senior');

        $user = JWTAuth::parseToken()->toUser()->toArray();
        
        $userRoles = array_first($user['user_roles'], function ($value, $key) {
            return $value->role_id >= $roleId;
        }, 0);
        
        if ($$userRoles >= $roleId)
            return $next($request);
        return response()->json([
            'error' => 'Invalid Permission.'
        ]);
    }
}
