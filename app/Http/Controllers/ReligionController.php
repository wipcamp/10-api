<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ReligionRepository;

class ReligionController extends Controller
{
    protected $religions;

    function __construct() {
        $this->religions = new ReligionRepository;
    }

    function get() {
        return $this->religions->get();
    }
}
