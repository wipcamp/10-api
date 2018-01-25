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
        return $dashboard->getProfileRegistrantAmountInToday();
    }
}
