<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AssignRepositoryInterface;

class AssignController extends Controller
{
    protected $assignRepo;

    public function __construct(AssignRepositoryInterface $assign) {
        $this->assignRepo = $assign;
    }

    public function getByProblemId($problemId) {
        $data = $this->assignRepo->getByProblemId($problemId);
        return json_encode($data);
    }

    public function getByRoleTeamId($roleTeamId) {
        $data = $this->assignRepo->getByRoleTeamId($roleTeamId);
        return json_encode($data);
    }

    public function getByAssignedId($assignedId) {
        $data = $this->assignRepo->getByAssignedId($assignedId);
        return json_encode($data);
    }
}
