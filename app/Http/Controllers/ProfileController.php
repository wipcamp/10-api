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

    function update(Request $request) {
        $data = $request->toArray();
        return $this->profiles->update($data);
    }

    function get() {
        return $this->profiles->get();
    }

    function getProfile($id) {
        return $this->profiles->getProfile($id);
    }
    
    function getRegistrants() {
        return $this->profiles->getRegistrants();
    }

    function getRegistrantsById($userId) {
        return $this->profiles->getRegistrantsById($userId);
    }
}
