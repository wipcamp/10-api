<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ApproveRepository;

class ApproveController extends Controller
{   
    protected $approveRepo;

    function __construct(){
        $this->approveRepo = new ApproveRepository();
    }
    //
    function Index(){
        return $this->approveRepo->getAllItimsWithDoc();
    }

    function Doctype($doctype){
        $document = new ApproveRepository();
        if(strtolower($doctype) == 'parentpermission'){
            return response()->json([
                'status' => 200,
                'data' => $document->getParentPermissionDocument()
            ]);
        }
        else if(strtolower($doctype) == 'transcript'){
            return response()->json([
                'status' => 200,
                'data' =>$document->getTransactionDocument()
            ]);
        }
        else{
            return 'hello ' . $req->name . ' : ' . $req->surname;
        }
    }
    function GetCheckTranscriptAmount(){
        return $this->Doctype('transcript')->count();
    }
    function GetCheckParentPermissionAmount(){
        return $this->Doctype('parentpermission')->count();        
    }
}

