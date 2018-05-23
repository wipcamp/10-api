<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProblemRepositoryInterface;
use App\Repositories\ExpoTokenRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;

class ProblemController extends Controller
{
    protected $problemRepo;
    protected $expoRepo;
    protected $notiRepo;

    public function __construct(ProblemRepositoryInterface $prob, ExpoTokenRepositoryInterface $expo, NotificationRepositoryInterface $noti) {
        $this->problemRepo = $prob;
        $this->expoRepo = $expo;
        $this->notiRepo = $noti;
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
        $priority_id = array_get($data, 'priority_id');
        
        $result = 'false';

        if(!is_null($topic) && !is_null($problem_type_id) &&
            !is_null($description) && !is_null($report_id) &&
            !is_null($priority_id)) {
            $result = $this->problemRepo->createProblem($topic, $problem_type_id, $description, $report_id, $priority_id);
        }

        return json_encode($result);
    }

    public function updateProblemAll($id, Request $request) {
        $data = $request->all();

        $topic = array_get($data, 'topic');
        $problem_type_id = array_get($data, 'problem_type_id');
        $description = array_get($data, 'description');
        $priority_id = array_get($data, 'priority_id');
        $is_solve = array_get($data, 'is_solve');
        $not_solve = array_get($data, 'not_solve');

        $result = false;

        if(!is_null($topic) && !is_null($problem_type_id) &&
            !is_null($description) && !is_null($priority_id) &&
            !is_null($is_solve) && !is_null($not_solve)) {
            $result = $this->problemRepo->updateProblemAll($id, $topic, $problem_type_id, $description, $priority_id, $is_solve, $not_solve);
        }

        return response()->json([
            'status' => $result
        ]);
    }

    public function updateProblem($id, Request $request) {
        $data = $request->all();

        $is_solve = array_get($data, 'is_solve');
        $not_solve = array_get($data, 'not_solve');
        
        $result = 'false';
        
        if($is_solve xor $not_solve) {
            $result = $this->problemRepo->updateProblem($id, $is_solve);
        }

        if($result == 'true') {
            $problem = $this->problemRepo->getProblem($id);
            $expoTokens = $this->expoRepo->getByUserId($problem->report_id);
            $title = "ปัญหา : " . $problem->topic;
            $tableName = "problems";
            foreach ($expoTokens as $expoToken) {
                if($is_solve) {
                    $this->notiRepo->createNotification(
                        $expoToken->user_id,
                        $expoToken->expo,
                        $title,
                        "ปัญหาของคุณได้รับการแก้ไขแล้ว",
                        $tableName,
                        $id
                    );
                }
                else {
                    $this->notiRepo->createNotification(
                        $expoToken->user_id,
                        $expoToken->expo,
                        $title,
                        "ปัญหาของคุณไม่ได้รับการแก้ไข",
                        $tableName,
                        $id
                    );
                }
            }
            
        }

        return json_encode($result);
    }
}
