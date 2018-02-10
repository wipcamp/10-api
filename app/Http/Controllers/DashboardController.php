<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    //
    function Index ()
    {
        $dashboard = new DashboardRepository();
        return response()->json([
            'status'=>200,
            'data'=>[
                'registerTodayAmount'=>$dashboard->getProfileRegistrantAmountInToday(),
                'campDetail'=>$dashboard->getCampDetail()
            ]
        ]);
    }
}
