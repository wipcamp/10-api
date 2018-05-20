<?php

namespace App\Http\Controllers;

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
        return response()->json([
            'status' => 200,
            'data' => $this->exams->insertAnswer()
        ]);
    }
}
