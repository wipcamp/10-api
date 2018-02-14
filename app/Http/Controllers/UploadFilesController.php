<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Repositories\DocumentRepository;

class UploadFilesController extends Controller
{
    public function customValidate($request) {
        $schema = [
            'userId' => 'required',
            'fileType' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,pdf|max:5120',
        ];

        if ($request['fileType'] == 'profile_picture') {
            $schema['file'] = 'required|mimes:jpeg,jpg,png|max:5120';
        }
        
        $validator = Validator::make($request->all(), $schema);
        if (!$request->hasFile('file') || $validator->fails()) {
            return true;
        }
        return false;
    }

    public function create(Request $request) {
        
        if ($this->customValidate($request)) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        // add data
        $contents['userId'] = $request['userId'];
        $contents['fileType'] = $request['fileType'];
        $contents['documentFormat'] = $request['file']->extension();
        
        // store file
        $file = $request->file('file')->store('public');
        $contents['path'] = Storage::url($file);
        
        // insert document
        $document = new DocumentRepository;
        $document = $document->create($contents);

        return response()->json([
            'status' => 200,
            'data' => $document
        ]);
    }

    public function update(Request $request) {

        if ($this->customValidate($request)) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
                
        // add data
        $contents['userId'] = $request['userId'];
        $contents['fileType'] = $request['fileType'];
        $contents['documentFormat'] = $request['file']->extension();
        
        // store file
        $file = $request->file('file')->store('public');
        $contents['path'] = Storage::url($file);
        
        // insert document
        $document = new DocumentRepository;
        $document = $document->update($contents);

        return response()->json([
            'status' => 200,
            'data' => $document
        ]);
    }
}