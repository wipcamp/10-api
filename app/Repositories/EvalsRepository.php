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
        return $this->evals->with(['eval_answer' => function ($query) use ($questionId) {
            $query->where('question_id', $questionId);
        }])->get();
    }
    public function insertEvals($evals) {
        return Evals::insert($evals);
    }

    public function updateEvals($answerId, $criteriaId, $eval) {
        return Evals::where([
            'answer_id' => $answerId,
            'criteria_id' => $criteriaId
        ])->update($eval);
    }
}