<?php
namespace App\Repositories;

use App\Models\UserRole;

use App\Repositories\RoleRepository;

class UserRoleRepository implements UserRoleRepositoryInterface {

  public function create($userId, $roleName) {
    $role = new RoleRepository;
    return UserRole::create([
        'user_id' => $userId,
        'role_id' => $role->getIdByName($roleName)
    ]);
  }

}