<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleTeamRepositoryInterface;

class RoleTeamController extends Controller
{
    protected $roleTeamRepo;

    public function __construct(RoleTeamRepositoryInterface $roleTeam) {
        $this->roleTeamRepo = $roleTeam;
    }

    public function getRoles() {
        return response()->json([
            'status' => 200,
            'data' => $this->roleTeamRepo->getRoles()
        ]);
    }

    public function getRole($roleId) {
        $data = $this->roleTeamRepo->getRoleTeam($roleId);
        return json_encode($data);
    }

    public function getByName($name) {
        $data = $this->roleTeamRepo->getIdByName($name);
        return json_encode($data);
    }
}
