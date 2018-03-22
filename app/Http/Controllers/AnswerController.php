<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    protected $answers;

    public function __construct(){
        $this->answers = new AnswerRepository;
    }

    function create(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'question_id' => 'required',
            'data' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->answers->create($data)
        ]);
    }

    function get() {
        $data = $this->answers->get();
        return $data;
    }

    function getById($userId, $questionId) {
        $data = $this->answers->getById($userId, $questionId);
        return json_encode(['data' => $data]);
    }

    function getAnswerById($answerId){
        return $this->answers->getAnswerById($answerId);
    }

    function getByTeam($teamId){
        $data = $this->answers->getSuccessRegistranceAnswerByTeam($teamId);
        return json_encode(['data' => $data]);
    }

    function getCheckerAnswer($questionId,$checkerId){
        return $this->answers->checkerAnswer($questionId,$checkerId);
    }


    function update(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'question_id' => 'required',
            'data' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
        
        return response()->json([
            'status' => 200,
            'data' => $this->answers->update($data)
        ]);
    }
        
    function getCountById($userId) {
        return response()->json([
            'status' => 200,
            'data' => $this->answers->getCountById($userId)
        ]);
    }
}
