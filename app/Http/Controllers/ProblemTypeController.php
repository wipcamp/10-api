<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProblemTypeRepositoryInterface;

class ProblemTypeController extends Controller
{
    protected $problemTypeRepo;

    public function __construct(ProblemTypeRepositoryInterface $probType) {
        $this->problemTypeRepo = $probType;
    }

    public function getAll() {
        $data = $this->problemTypeRepo->getAll();
        return $data;
    }

    public function getProblemType($id) {
        $data = $this->problemTypeRepo->getProblem($id);
        return $data;
    }
}
