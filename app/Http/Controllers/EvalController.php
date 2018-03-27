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
       return DB::select('select * from evals where answer_id = '.$answerId);
    }
    function getCriteriaByAnswer ($questionId){
        return DB::select('select * from eval_criterias where question_id = '.$questionId);
    }
    function postCriteria(Request $request){//Insert into eval by criteria
        return DB::table('evals')->insert([
            'answer_id' => $request->input('answer_id'),
            'criteria_id'=> $request->input('criteria_id'),
            'checker_id' => $request->input('checker_id'),
            'score' => $request->input('score')
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
}
