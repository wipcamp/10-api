<?php
namespace App\Repositories;

interface ProblemRepositoryInterface {
    public function getAll();
    public function getProblem($id);
    public function createProblem($topic, $problem_type_id, $description, $report_id, $priority_id);
    public function updateProblem($id, $is_solve);
    public function updateProblemAll($id, $topic, $problem_type_id, $description, $priority_id, $is_solve, $not_solve);
}