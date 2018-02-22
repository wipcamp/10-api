<?php
namespace App\Repositories;

use App\Models\UserRoleTeam;

class UserRoleTeamRepository implements UserRoleTeamRepositoryInterface {

    public function getByUserId($userId) {
        $data = UserRoleTeam::where('user_id', $userId)->get();
        return $data;
    }

}