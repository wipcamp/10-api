<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    protected $questions;

    function __construct() {
        $this->questions = new QuestionRepository;
    }

    function get(Request $request) {
        return $this->questions->get();
    }

    function getById($questionId) {
        return $this->questions->getById($questionId);
    }

    function getByTeam($teamId) {
        return $this->questions->getByTeam($teamId);
    }

    function getQuestionCriteriasByID($questionId){
        return $this->questions->getQuestionCriteriasByID($questionId);
    }
}
