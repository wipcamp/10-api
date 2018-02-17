<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\UserRole;

class RoleRepository implements RoleRepositoryInterface {

  public function getIdByName($roleName) {
    return Role::where('name',  $roleName)->first()->id;
  }

  public function createStaff($id, $roleId) {
    return UserRole::create([
      'user_id' => $id,
      'role_id' => $roleId
    ]);
  }

}