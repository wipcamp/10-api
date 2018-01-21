<?php
namespace App\Repositories;
use App\Models\EvalQuestion;

class QuestionRepository implements QuestionRepositoryInterface {
    protected $questions;

    public function __construct(){
        $this->questions = new EvalQuestion;
    }

    public function get() {
        return 'get question';
    }
}