<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Evals;
class EvalsRepository implements EvalsRepositoryInterface {
    protected $evals;
    public function getEvals(){
        $this->evals = new Evals();
        return $this->evals->with('eval_answer')->get();
    }
    public function getEvalsByQuestionId($questionId){
        $this->evals = new Evals();
        return $this->evals->with('eval_answer')->where('question_id',$questionId)->get();
    }
}