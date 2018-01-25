<?php
namespace App\Repositories;

use App\Models\Problem;

class ProblemRepository implements ProblemRepositoryInterface {
    public function getAll() {
        $data = Problem::all();
        return $data;        
    }
    
    public function getProblem($id) {
        $data = Problem::find($id);
        return $data;
    }

    public function createProblem($topic, $problem_type_id, $description, $report_id) {
        $newProblem = new Problem;

        $newProblem->topic = $topic;
        $newProblem->problem_type_id = $problem_type_id;
        $newProblem->description = $description;
        $newProblem->report_id = $report_id;
        $newProblem->is_solve = false;
        $newProblem->not_solve = false;                
        
        $newProblem->save();

        return 'true';
    }
}