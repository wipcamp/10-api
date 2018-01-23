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
                '0' => ['id'=>0,'name'=>'farang','surname'=>'emmel',
                    'document'=>[
                        '0'=>['name'=>'Transcript','isApprove'=>0],
                        '1'=>['name'=>'ParentPermission','isApprove'=>1]
                    ]
                ],
                '1' => ['id'=>1,'name'=>'bas','surname'=>'tualek',
                    'document'=>[
                        '0'=>['name'=>'Transcript','isApprove'=>1],
                        '1'=>['name'=>'ParentPermission','isApprove'=>0]
                    ]
                ]
            ]
        ]); 
    }
    function WithParams(Request $req){
        if($req->name == 'ParentPermission'){
            return response()->json([
                status => 200,
                data =>[
                    '0' => ['user_id'=>10001,'camp_id'=>10,'type_id'=>1,'format_id'=>1,'path'=>'https://wip.camp/img/parent/12378912312.png','is_approve'=>0],
                    '1' => ['user_id'=>10031,'camp_id'=>10,'type_id'=>1,'format_id'=>1,'path'=>'https://wip.camp/img/parent/87778732312.png','is_approve'=>1]
                ]
            ]);
        }
        else if($req->name == 'Transcript'){
            return response()->json([
                status => 200,
                data =>[
                    '0' => ['user_id'=>10001,'camp_id'=>10,'type_id'=>2,'format_id'=>1,'path'=>'https://wip.camp/img/transcript/12378912312.png','is_approve'=>0],
                    '1' => ['user_id'=>10031,'camp_id'=>10,'type_id'=>2,'format_id'=>1,'path'=>'https://wip.camp/img/transcript/87778732312.png','is_approve'=>1]
                ]
            ]);
        }
        else{
            return 'hello ' . $req->name . ' : ' . $req->surname;
        }
    }
    function GetCheckTranscriptAmount(){
        return 31;
    }
    function GetCheckParentPermissionAmount(){
        return 44;
    }
}

