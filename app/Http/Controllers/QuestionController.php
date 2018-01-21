<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    protected $questions;

    function get(Request $request) {
        $this->questions = new QuestionRepository;
        return $this->questions->get();
    }
}
