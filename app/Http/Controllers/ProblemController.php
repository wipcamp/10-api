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
        $data = $this->problemRepo->post($request);
        return $data;
    }
}
