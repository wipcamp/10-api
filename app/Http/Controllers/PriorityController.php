<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PriorityRepositoryInterface;

class PriorityController extends Controller
{
    protected $priorityRepo;

    public function __construct(PriorityRepositoryInterface $priority) {
        $this->priorityRepo = $priority;
    }

    public function getAll() {
        $data = $this->priorityRepo->getAll();
        return json_encode($data);
    }

    public function getPriority($priorityId) {
        $data = $this->priorityRepo->getPriority($priorityId);
        return json_encode($data);
    }
}
