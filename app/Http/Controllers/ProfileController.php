<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfileRepository;

class ProfileController extends Controller
{
    protected $profiles;

    function __construct() {
        $this->profiles = new ProfileRepository;
    }

    function create(Request $request) {
        $data = $request->toArray();
        return $this->profiles->create($data);
    }
}
