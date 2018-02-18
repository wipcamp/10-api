<?php

namespace App\Http\Middleware;

use App\Repositories\RoleRepository;

class CheckRole
{
    public function dynamicCheckRole($user, $roleName, $next) {
        $roleRepo = new RoleRepository;
        $this->roleId = $roleRepo->getIdByName($roleName);
        $user['user_roles'] = $roleRepo->getIdByUserId($user['id'])->toArray();

        $userRoles = array_first($user['user_roles'], function ($value, $key) {
            return $value['role_id'] >= $this->roleId;
        }, 0);
        
        if ($userRoles['role_id'] >= $this->roleId)
            return $next($request);
        return response()->json([
            'error' => 'Invalid Permission.'
        ]);
    }
}