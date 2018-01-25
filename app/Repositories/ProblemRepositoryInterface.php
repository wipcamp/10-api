<?php
namespace App\Repositories;

interface ProblemRepositoryInterface {
    public function getAll();
    public function getProblem($id);
    public function post(Request $request);
}