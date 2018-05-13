<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\CamperRepository;
use Illuminate\Database\QueryException;

class CamperController extends Controller
{
    function __construct() {
        $this->camper = new CamperRepository;
    }

    public function getCamperByUserId($userId) {
        $camper = $this->camper->getCamperByUserId($userId);
        if ($camper) {
            return response()->json([
                'status' => 200,
                'data' => $camper
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => false
        ]);
    }
    
    public function getAllCampers() {
        return response()->json([
            'status' => 200,
            'data' => $this->camper->getAllCampers()
        ]);
    }

    public function getCamperByPersonId($personId) {
        $camper = $this->camper->getCamperByPersonId($personId);
        if ($camper) {
            return response()->json([
                'status' => 200,
                'data' => $camper
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => false
        ]);
    }

    public function updateFlavor(Request $request, $userId) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'sectionId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $result;
        try {
            $result = $this->camper->updateFlavor($userId, $data['sectionId']);
        } catch (QueryException $e) {
            $result = $e;
        }
        
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }
}
