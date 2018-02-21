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
            'stdId' => 'required'
        ];

        $validator = Validator::make($user, $schema);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $profile = new ProfileRepository;
        if (blank($profile->getProfile($user['userId']))) {
            $profile->createStaff([
                'user_id' => $user['userId'],
                'first_name' => '',
                'first_name_en' => '',
                'last_name' => '',
                'last_name_en' => '',
                'nickname' => '',
                'gender_id' => 1,
                'religion_id' => 1,
                'blood_group' => 'ไม่ทราบ',
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->staffs->create(
                $user['userId'],
                $user['stdId']
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
}
