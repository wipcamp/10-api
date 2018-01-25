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
        $data = $this->problemRepo->get();
        return $data;
    }

    public function get($id) {
        $data = $this->problemRepo->get($id);
        return $data;
    }

    public function post(Request $request) {
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
}
