<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadFilesController extends Controller
{
    public function create(Request $request) {
        return $request->file('file')->store('files');
    }
}