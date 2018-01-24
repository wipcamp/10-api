<?php
namespace App\Repositories;

use App\Models\ProblemType;

class ProblemTypeRepository implements ProblemTypeRepositoryInterface {
    public function get($id = null) {
        $data;
        if($id == null) {
            $data = ProblemType::all();
        }
        else {
            $data = ProblemType::find($id);
        } 
        return $data;
    }
}