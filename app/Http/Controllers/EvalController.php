<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\EvalsRepository;
use DB;

class EvalController extends Controller
{
    //
    function __construct() {
        $this->evals = new EvalsRepository;
    }
    function Index ()
    {
        return response()->json([
            'status'=>200,
            'data'=>$this->evals->getEvals()
        ]);
    }
    function getEvalsById ($answerId)
    {
       return DB::select('select * from evals where answer_id = '.$answerId.' order by criteria_id');
    }
    function getCriteriaByAnswer ($questionId){
        return DB::select('select * from eval_criterias where question_id = '.$questionId);
    }
    function postCriteria(Request $request){//Insert into eval by criteria
        $evals = $request->all();

        return response()->json([
            'status' => 200,
            'data' => $this->evals->insertEvals($evals)
        ]);
    }
    
    function putCriteria($criteriaId,Request $request){
        
        return DB::table('evals')->where('id', $criteriaId)
        ->update([
            'answer_id' => $request['answer_id'],
            'criteria_id'=> $request['criteria_id'],
            'checker_id' => $request['checker_id'],
            'score' => $request->input('score')
        ]);
    }

    function putCriterias(Request $request){
        $evals = $request->all();

        foreach ($evals as $eval) {
            $this->evals->updateEvals(
                $eval['answer_id'],
                $eval['criteria_id'],
                $eval
            );
        }

        return response()->json([
            'status' => 200,
            'data' => true
        ]);
    }
}
