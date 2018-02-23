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

    public function getByName($name) {
        $data = $this->roleTeamRepo->getIdByName($name);
        return json_encode($data);
    }
}
