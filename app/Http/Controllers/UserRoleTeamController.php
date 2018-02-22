<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRoleTeamRepositoryInterface;

class UserRoleTeamController extends Controller
{
    protected $userRoleTeamRepo;

    public function __construct(UserRoleTeamRepositoryInterface $userRoleTeam) {
        $this->userRoleTeamRepo = $userRoleTeam;
    }

    public function getByUserId($userId) {
        $data = $this->userRoleTeamRepo->getByUserId($userId);
        return json_encode($data);
    }
}
