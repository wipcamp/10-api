<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Repositories\RoleRepository;

class CheckUserByUserId
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
        $user = JWTAuth::parseToken()->toUser()->toArray();
        
        $roleName = 'camp_staffs_speacials';
        $roleRepo = new RoleRepository;
        $this->roleId = $roleRepo->getIdByName($roleName);
        $user['user_roles'] = $roleRepo->getIdByUserId($user['id'])->toArray();
        $userRoles = array_first($user['user_roles'], function ($value, $key) {
            return $value['role_id'] >= $this->roleId;
        }, 0);

        if ($userRoles['role_id'] >= $this->roleId || $user['id'] == $request['userId'])
            return $next($request);
        return response()->json([
            'error' => 'Invalid User.'
        ]);
    }
}
