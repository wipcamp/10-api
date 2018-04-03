<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SlipRepository;

class SlipController extends Controller
{   
    protected $slip;

    public function __construct()
    {
        $this->slip = new SlipRepository;
    }

    function allCampers() 
    {
        return $this->slip->getCamperWithDoc();
    }
}
