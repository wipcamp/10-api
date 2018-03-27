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
    return DB::select('select e.*,c.* from evals e join eval_answers a on e.answer_id = a.id join users u on e.checker_id = u.id left join eval_criterias c on e.criteria_id = c.id');
  }

  function updateEvalsByQuestionId(){

  }

  function createEval($answerId,$criteriaId,$score){
    
  }

}