<?php

namespace App\Repositories;

use App\Models\Priority;

class PriorityRepository implements PriorityRepositoryInterface {
    public function getAll() {
        $data = Priority::all();
        return $data;        
    }
    
    public function getPriority($priorityId) {
        $data = Priority::find($priorityId);
        return $data;
    }
}