<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Problem;

class ProblemRepository implements ProblemRepositoryInterface {
    public function get($id = null) {
        $data;
        if($id == null) {
            $data = Problem::all();
        }
        else {
            $data = Problem::find($id);
        } 
        return $data;
    }

    // public function ($topic) {
    //     $newProblem = new Problem;

    //     $newProblem->topic = $request->topic;
    //     $newProblem->problem_type_id = $request->problem_type_id;
    //     $newProblem->description = $request->description;
    //     $newProblem->report_id = $request->report_id;
    //     $newProblem->is_solve = false;
    //     $newProblem->not_solve = false;                
        
    //     $newProblem->save();

    //     return true;
    // }
}