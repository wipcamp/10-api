<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    protected $answers;

    function create(Request $request) {
        $this->questions = new AnswerRepository;
        $data = $request->toArray();
        return $this->questions->create($data);
    }
}
