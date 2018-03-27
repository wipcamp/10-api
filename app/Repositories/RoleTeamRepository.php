<?php
namespace App\Repositories;

use App\Models\RoleTeam;

class RoleTeamRepository implements RoleTeamRepositoryInterface {

    public function getIdByName($roleName) {
        return RoleTeam::where('name',  $roleName)->first()->id;
    }
    public function getRoles() {
        return RoleTeam::get();
    }

}