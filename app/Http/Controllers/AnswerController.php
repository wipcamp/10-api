<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    protected $answers;

    public function __construct(){
        $this->answers = new AnswerRepository;
    }

    function create(Request $request) {
        $data = $request->toArray();
        return $this->answers->create($data);
    }

    function get() {
        $data = $this->answers->get();
        return $data;
    }

    function getById($user_id, $question_id) {
        $data = $this->answers->getById($user_id, $question_id);
        return json_encode(['data' => $data]);
    }

    function update(Request $request) {
        $data = $request->toArray();
        $result = $this->answers->update($data);
        if ($result = 1) {
            return json_encode(['result' => true]);
        }
        return json_encode(['result' => false]);
    }
}
