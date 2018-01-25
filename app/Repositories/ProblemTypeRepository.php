<?php
namespace App\Repositories;

use App\Models\ProblemType;

class ProblemTypeRepository implements ProblemTypeRepositoryInterface {
    public function getAll() {
        $data = ProblemType::all();
        return $data;
    }
    
    public function getProblemType($id) {
        $data  = ProblemType::find($id);
        return $data;
    }
}