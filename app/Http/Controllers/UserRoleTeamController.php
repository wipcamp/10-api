<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\UserRoleTeamRepositoryInterface;
use App\Repositories\RoleTeamRepository;
use App\Repositories\UserRepository;

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

    public function create(Request $request) {
        $user = $request->all();

        $validator = Validator::make($user, [
            'user_id' => 'required',
            'name' => 'required'
        ]);
                
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
        
        $userRepo = new UserRepository;
        $roleTeamRepo = new RoleTeamRepository;

        $userData = $userRepo->getByUserId($user['user_id']);
        $roleTeamId = $roleTeamRepo->getIdByName($user['name']);

        if ($userData && $roleTeamId) {
            $user = $this->userRoleTeamRepo->create(
                $user['user_id'],
                $roleTeamId
            );
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        }

        return response()->json([
            'status' => 406,
            'message' => 'Data Errors'
        ]);
    }
}
