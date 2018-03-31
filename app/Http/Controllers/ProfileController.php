<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\ProfileRepository;
use App\Repositories\DashboardRepository;

class ProfileController extends Controller
{
    protected $profiles;
    protected $dashboard;


    function __construct() {
        $this->profiles = new ProfileRepository;
        $this->dashboard  = new DashboardRepository;
    }

    function create(Request $request) {
        $schema = [
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'first_name_en' => 'required',
            'last_name_en' => 'required',
            'nickname' => 'required',
            'gender_id' => 'required',
            'citizen_id' => 'required',
            'religion_id' => 'required',
            'birth_at' => 'required',
            'blood_group' => 'required',
            'congenital_diseases' => 'required',
            'allergic_foods' => 'required',
            'congenital_drugs' => 'required',
            'addr_prov' => 'required',
            'addr_dist' => 'required',
            'telno_personal' => 'required',
            'edu_name' => 'required',
            'edu_lv' => 'required',
            'edu_major' => 'required',
            'edu_gpax' => 'required',
            'parent_relation' => 'required',
            'telno_parent' => 'required',
        ];
        // get data
        $data = $request->all();
        // validate
        $validator = Validator::make($data, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => $this->profiles->create($data)
        ]);
    }

    function updateLeaveCamper(Request $request) {
        $schema = [
            'userId' => 'required',
            'reason' => 'required',
        ];
        
        $data = $request->all();

        // validate
        $validator = Validator::make($data, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
        
        $user = [
            'user_id' => $data['userId'],
            'tell_wipper' => $data['reason']
        ];

        return response()->json([
            'status' => 200,
            'data' => $this->profiles->updateLeaveCamper($user)
        ]);
    }

    function get() {
        return $this->profiles->get();
    }

    function getProfile($id) {
        return $this->profiles->getProfile($id);
    }
    
    function getRegistrants() {
        return $this->profiles->getRegistrants();
    }

    function getSuccessRegistrants(){
        return $this->dashboard->getAllSuccessRegister();
    }

    function getRegistrantsById($userId) {
        return $this->profiles->getRegistrantsById($userId);
    }

    function getRegistrantsForEvaluate() {
        return response()->json([
            'status' => 200,
            'data' => $this->profiles->getRegistrantsForEvaluate()
        ]);
    }
}
