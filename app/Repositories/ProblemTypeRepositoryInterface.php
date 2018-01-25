<?php
namespace App\Repositories;

interface ProblemTypeRepositoryInterface {
    public function getAll();
    public function getProblemType($id);
}