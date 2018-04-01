<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CamperRepository;

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
}
