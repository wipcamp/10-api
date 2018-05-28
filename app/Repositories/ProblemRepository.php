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

    public function createProblem($topic, $problem_type_id, $description, $report_id, $priority_id) {
        $newProblem = new Problem;

        $newProblem->topic = $topic;
        $newProblem->problem_type_id = $problem_type_id;
        $newProblem->description = $description;
        $newProblem->report_id = $report_id;
        $newProblem->priority_id = $priority_id;
        $newProblem->is_solve = false;
        $newProblem->not_solve = false;
        
        $newProblem->save();

        return $newProblem->id;
    }

    public function updateProblem($id, $is_solve) {
        $problem = Problem::find($id);

        if($is_solve) {
            $problem->is_solve = true;
        }
        else {
            $problem->not_solve = true;
        }

        $problem->save();

        return 'true';
    }

    public function updateProblemAll($id, $topic, $problem_type_id, $description, $priority_id, $is_solve, $not_solve) {
        $problem = Problem::find($id);

        $problem->topic = $topic;
        $problem->problem_type_id = $problem_type_id;
        $problem->description = $description;
        $problem->priority_id = $priority_id;
        $problem->is_solve = $is_solve;
        $problem->not_solve = $not_solve;
        
        $problem->save();
        return true;
    }
}