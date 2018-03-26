<?php
namespace App\Repositories;
use App\Models\Evals;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EvalsRepository implements EvalsRepositoryInterface {
  protected $evals;

  public function __construct(){
    $this->evals = new Evals();
  }

  function getEvals(){
      return $this->evals->get();
  }

  function getEvalsQuestionByQuestionId($questionId){
    return $this->evals->where('question_id',$questionId)->get();
  }

  function createEval($answerId,$criteriaId,$score){
    
  }

}