<?php
namespace App\Repositories;
use App\Models\CampSection;

class FlavorRepository implements FlavorRepositoryInterface {
    protected $flavors;

    public function getAllFlavors(){
        $this->flavors = new CampSection;
        return $this->flavors->with('section_scores')->get();
    }

}