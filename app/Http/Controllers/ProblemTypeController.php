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
        $data = $this->problemTypeRepo->get();
        return $data;
    }

    public function get($id) {
        $data = $this->problemTypeRepo->get($id);
        return $data;
    }
}
