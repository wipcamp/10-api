<?php
namespace App\Repositories;

use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface {

  public function getIdByName($roleName) {
    return Role::where('name',  $roleName)->first()->id;
  }

}