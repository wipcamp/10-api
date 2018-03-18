<?php
namespace App\Repositories;

use App\Models\Camp;

class CampRepository implements CampRepositoryInterface {
    protected $camp;
    public function getBySeason($season){
        $this->camp = new Camp();
        return $this->camp->where('season', $season)->get();
        
    }
}