<?php
namespace App\Repositories;
use App\Models\EvalQuestion;
use Illuminate\Support\Facades\DB;


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
            ->with('eval_criteria')
            ->where('id', $question_id)
            ->get();
        return $result;
    }

    public function getQuestionCriteriasByID($questionId){
        return DB::select('select * from eval_criterias where question_id = '.$questionId);
      }

    public function getByTeam($teamId)
    {
        return DB::select('select * from eval_questions where question_role_teams = '.$teamId);
    }
}