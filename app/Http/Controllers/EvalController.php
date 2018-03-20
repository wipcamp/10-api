<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EvalsRepository;

class EvalController extends Controller
{
    //
    function __construct() {
        $this->evals = new EvalsRepository;
    }
    function Index ()
    {
        return response()->json([
            'status'=>200,
            'data'=>[
                
            ]
        ]);
    }
    
}
