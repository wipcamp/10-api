<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfileRepository;
use App\Repositories\StaffRepository;
use Validator;

class StaffController extends Controller
{
    protected $staffs;

    public function __construct() {
        $this->staffs = new StaffRepository;
    }

    public function create(Request $request) {
        $user = $request->all();
        // validate
        $schema = [
            'userId' => 'required',
            'stdId' => 'required',
            'flavorId' => 'required'
        ];

        $validator = Validator::make($user, $schema);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->staffs->create(
                $user['userId'],
                $user['stdId'],
                $user['flavorId']
            )
        ]);
    }

    public function getStaff($userId) {
        return response()->json([
            'status' => 200,
            'data' => $this->staffs->getStaff($userId)
        ]);
    }

    public function get() {
        return response()->json([
            'status' => 200,
            'data' => $this->staffs->getAll()
        ]);
    }

    public function getNonApprove() {
        return $this->staffs->getNonApprove();
    }
}
