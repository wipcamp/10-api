<?php
namespace App\Repositories;
use App\Models\EvalQuestion;

class QuestionRepository implements QuestionRepositoryInterface {
    protected $questions;

    public function __construct(){
        $this->questions = new EvalQuestion;
    }

    public function get() {
        return $this->questions->get();
    }

    public function getById($question_id) {
        $result = $this->questions
            ->where('id', $question_id)
            ->get();
        return $result;
    }
}