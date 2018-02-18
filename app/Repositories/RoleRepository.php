<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\UserRole;

class RoleRepository implements RoleRepositoryInterface {

  public function getIdByName($roleName) {
    return Role::where('name',  $roleName)->first()->id;
  }
  
  public function getIdByUserId($userId) {
    return UserRole::where('user_id',  $userId)->get();
  }

  public function createStaff($id, $roleId) {
    return UserRole::create([
      'user_id' => $id,
      'role_id' => $roleId
    ]);
  }

}