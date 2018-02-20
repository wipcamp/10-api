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
        return response()->json($this->dashboard->getAllSuccessRegister());
    }

    function getAllRegister () {
        return response()->json($this->dashboard->getAllRegister());
    }
    function getAllUserDocSuccess () {
        return response()->json($this->dashboard->getAllUserDocSuccess());
    }
    function getAllProfileSuccess () {
        return response()->json($this->dashboard->getAllProfileSuccess());
    }
}
