<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\ExamRepositoryInterface;

class ExamController extends Controller
{
    protected $exams;

    function __construct(ExamRepositoryInterface $exams) {
        $this->exams = $exams;
    }

    function getAll(Request $request) {
        return response()->json([
            'status' => 200,
            'data' => $this->exams->getAll()
        ]);
    }

    function insertAnswer(Request $request) {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $answers = $request->get('data');
        $result = null;

        try {
            $result = $this->exams->insertAnswer($answers);
        } catch (Exception $err) {
            $result = $err;
        }
        
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }
}
