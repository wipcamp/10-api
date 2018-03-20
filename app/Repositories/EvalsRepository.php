<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Evals;
class EvalsRepository implements EvalsRepositoryInterface {
    protected $evals;
    public function getEvals(){
        $this->evals = new Evals();
        return $this->evals->get();
    }
    public function getEvalsByQuestionId($questionId){
        $this->evals = new Evals();
        return $this->evals->where('question_id',$questionId)->get();
    }
}