<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApproveController extends Controller
{
    //
    function Index(){
        return response()->json([
            'status' => 200,
            'message' => 'Hi! Approve',
            'array' => [
                '0' => ['id'=>0,'name'=>'farang','surname'=>'emmel'],
                '1' => ['id'=>1,'name'=>'bas','surname'=>'tualek']
            ]
        ]); 
    }
    function WithParams(Request $req){
        return 'hello ' . $req->name . ' : ' . $req->surname;
    }
}
