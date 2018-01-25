<?php
namespace App\Repositories;

interface ProblemRepositoryInterface {
    public function getAll();
    public function getProblem($id);
    public function createProblem($topic, $problem_type_id, $description, $report_id);
    public function updateProblem($id, $is_solve);
}