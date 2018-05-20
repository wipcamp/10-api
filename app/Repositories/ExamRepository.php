<?php
namespace App\Repositories;
use App\Models\Exam;
use App\Models\ExamQuestion;

class ExamRepository implements ExamRepositoryInterface {
    public function getAll() {
        return ExamQuestion::with('exam_choices')->get();
    }

    public function insertAnswer() {
        return 'hi';
    }
}