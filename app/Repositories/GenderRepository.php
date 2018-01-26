<?php
namespace App\Repositories;
use App\Models\ProfileGender;

class GenderRepository implements GenderRepositoryInterface {
  protected $genders;

  public function __construct(){
    $this->genders = new ProfileGender;
  }

  public function get() {
    $result = $this->genders->get();
    return $result;
  }
}