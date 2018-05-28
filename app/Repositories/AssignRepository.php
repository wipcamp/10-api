<?php
namespace App\Repositories;

use App\Models\Assign;

class AssignRepository implements AssignRepositoryInterface {
    public function getAssign($assignId) {
        $data = Assign::find($assignId);
        return $data;
    }

    public function create($data) {
        $assign = new Assign($data);
        $assign->save();
        return $data;
      }


    public function deleteByProblemId($problemId) {
        $data = Assign::where('problem_id', $problemId)->delete();
        return $data;
    }

    public function getByProblemId($problemId) {
        $data = Assign::where('problem_id', $problemId)->get();
        return $data;
    }

    public function getByRoleTeamId($roleTeamId) {
        $data = Assign::where('role_team_id', $roleTeamId)->get();
        return $data;
    }

    public function getByAssignedId($assignedId) {
        $data = Assign::where('assigned_id', $assignedId)->get();
        return $data;
    }
}