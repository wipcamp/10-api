<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProblemRepositoryInterface;

class ProblemController extends Controller
{
    protected $problemRepo;

    public function __construct(ProblemRepositoryInterface $prob) {
        $this->problemRepo = $prob;
    }

    public function getAll() {
        $data = $this->problemRepo->getAll();
        return json_encode($data);
    }

    public function getProblem($id) {
        $data = $this->problemRepo->getProblem($id);
        return json_encode($data);
    }

    public function createProblem(Request $request) {
        $data = $request->all();

        $topic = array_get($data, 'topic');
        $problem_type_id = array_get($data, 'problem_type_id');
        $description = array_get($data, 'description');
        $report_id = array_get($data, 'report_id');
        
        $result = 'false';

        if(!is_null($topic) && !is_null($problem_type_id) && !is_null($description) && !is_null($report_id)) {
            $result = $this->problemRepo->createProblem($topic, $problem_type_id, $description, $report_id);
        }

        return json_encode($result);
    }

    public function updateProblem($id, Request $request) {
        $data = $request->all();

        $is_solve = array_get($data, 'is_solve');
        $not_solve = array_get($data, 'not_solve');
        
        $result = 'false';

        if($is_solve xor $not_solve) {
            $result = $this->problemRepo->updateProblem($id, $is_solve);
        }

        return json_encode($result);
    }
}
