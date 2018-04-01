<?php
namespace App\Repositories;

use App\Models\RoleTeam;

class RoleTeamRepository implements RoleTeamRepositoryInterface {

    public function getRoles() {
        return RoleTeam::get();
    }

    public function getRoleTeam($roleId) {
        return RoleTeam::find($roleId);
    }

    public function getIdByName($roleName) {
        return RoleTeam::where('name',  $roleName)->first()->id;
    }
}