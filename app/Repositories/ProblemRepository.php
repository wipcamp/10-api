<?php
namespace App\Repositories;

use App\Models\Problem;

class ProblemRepository implements ProblemRepositoryInterface {
    public function get($id = null) {
        $data;
        if($id == null) {
            $data = Problem::all();
        }
        else {
            $data = Problem::find($id);
        } 
        return $data;
    }
}