<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfileRepository;

class ProfileController extends Controller
{
    protected $profiles;

    function create(Request $request) {
        $this->profiles = new ProfileRepository;
        $data = $request->toArray();
        return $this->profiles->create($data);
    }
}
