<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    function __construct() {
        $this->dashboard = new DashboardRepository;
    }
    function Index ()
    {
        return response()->json([
            'status'=>200,
            'data'=>[
                'registerTodayAmount'=>$this->dashboard->getProfileRegistrantAmountInToday(),
                'campDetail'=>$this->dashboard->getCampDetail()
            ]
        ]);
    }
    
    function getAllSuccessRegister () {
        return response()->json([
            'status' => 200,
            'data' => $this->dashboard->getAllSuccessRegister()
        ])
    }
}
