<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Repositories\DocumentRepository;

class UploadFilesController extends Controller
{
    public function create(Request $request) {
        // check file
        if (!$request->hasFile('file')) {
            return response()->json([
                'error' => 'Invalid File.'
            ]);
        }
        
        // add data
        $contents['userId'] = $request['userId'];
        $contents['fileType'] = $request['fileType'];
        $contents['documentFormat'] = image_type_to_mime_type(exif_imagetype($request['file']));

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
        $path = $request->file('file')->store('files');
        return $path;
    }
}