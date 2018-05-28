<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\AssignRepositoryInterface;

class AssignController extends Controller
{
    protected $assignRepo;

    public function __construct(AssignRepositoryInterface $assign) {
        $this->assignRepo = $assign;
    }

    public function getAssign($assignId) {
        $data = $this->assignRepo->getAssign($assignId);
        return json_encode($data);
    }

    public function createAssign(Request $request) {
        $data = $request->all();
        $result = array_get($data, 'data');
        
        $temp = true;
        foreach($result as $obj) {
            $schema = [
                'problem_id' => 'required',
                'role_team_id', // role_team
                'assigned_id' // wipid
            ];
            $validator = Validator::make($obj, $schema);
            if ($validator->fails()) {
                $temp = false;
                return response()->json(false);
            }
            $this->assignRepo->create($obj);
        }
        
        return response()->json($temp);
    }

    public function updateAssign(Request $request, $id) {
        $data = $request->all();
        $result = array_get($data, 'data');

        $this->assignRepo->deleteByProblemId($id);
        $temp = true;
        foreach($result as $obj) {
            $schema = [
                'problem_id' => 'required',
                'role_team_id', // role_team
                'assigned_id' // wipid
            ];
            $validator = Validator::make($obj, $schema);
            if ($validator->fails()) {
                $temp = false;
                return response()->json(false);
            }
            $this->assignRepo->create($obj);
        }
        
        return response()->json($temp);
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
