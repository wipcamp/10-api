<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DocumentRepository;
use App\Repositories\ConfirmCamperRepository;

class ConfirmController extends Controller
{
    function __construct() {
        $this->camper = new ConfirmCamperRepository;
    }

    public function insertConfirmCamper(Request $request) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'userId' => 'required',
            'place' => 'string|required',
            'comeByYourself' => 'string|required',
            'shirtSize' => 'string|required',
            'fileType' => 'string|required',
            'file' => 'required|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        if (!$request->hasFile('file') || $validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        if ($request['fileType'] != 'bank_payment_slip') {
            return response()->json([
                'error' => 'Invalid File Type.'
            ]);
        }

        $slip = new DocumentRepository;

        $camper = [
            'user_id' => $data['userId'],
            'place' => $data['place'],
            'come_by_self' => $data['comeByYourself'],
            'shirt_size' => $data['shirtSize'],
        ];

        // store file
        $file = $request->file('file')->store('public');
        
        $contents = [
            'userId' => $data['userId'],
            'fileType' => $request['fileType'],
            'documentFormat' => $request['file']->extension(),
            'path' => Storage::url($file),
        ];
        
        return response()->json([
            'status' => 200,
            'data' => [
                'confirm' => $this->camper->insertConfirmCamper($camper),
                'uploaded' => !blank($slip->create($contents))
            ]
        ]);
    }
}
