<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FlavorRepository;

class FlavorController extends Controller
{
    //
    function __construct() {
        $this->flavors = new FlavorRepository;
    }

    function getAllFlavors() {
        return response()->json([
            'status' => 200,
            'data' => $this->flavors->getAllFlavors()
        ]);
    }
}
