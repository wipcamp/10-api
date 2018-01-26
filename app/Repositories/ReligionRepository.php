<?php
namespace App\Repositories;
use App\Models\ProfileReligion;

class ReligionRepository implements ReligionRepositoryInterface {
  protected $religions;

  public function __construct(){
    $this->religions = new ProfileReligion;
  }

  public function get() {
    $result = $this->religions->get();
    return $result;
  }
}