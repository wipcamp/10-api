<?php
namespace App\Repositories;

use App\Models\UserRoleTeam;

class UserRoleTeamRepository implements UserRoleTeamRepositoryInterface {

    public function getByUserId($userId) {
        $data = UserRoleTeam::where('user_id', $userId)->get();
        return $data;
    }

    public function create($userId, $roleTeamId) {
        return UserRoleTeam::create([
            'user_id' => $userId,
            'role_team_id' => $roleTeamId
        ]);
    }

}