<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    protected $answers;

    function create(Request $request) {
        $this->answers = new AnswerRepository;
        $data = $request->toArray();
        return $this->answers->create($data);
    }

    function get() {
        $this->answers = new AnswerRepository;
        $data = $this->answers->get();
        return $data;
    }
}
