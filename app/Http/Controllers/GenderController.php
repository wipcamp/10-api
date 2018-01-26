<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\GenderRepository;

class GenderController extends Controller
{
    protected $genders;

    function __construct() {
        $this->genders = new GenderRepository;
    }

    function get() {
        return $this->genders->get();
    }
}
