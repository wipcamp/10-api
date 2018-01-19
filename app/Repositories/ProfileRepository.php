<?php
namespace App\Repositories;
use App\Models\Profile;

class ProfileRepository implements ProfileRepositoryInterface {
  protected $profiles;

  public function __construct(){
    $this->profiles = new Profile;
  }

  public function create($data) {
    $this->profiles = new Profile($data);
    return json_encode(['result' => $this->profiles->save()]);
  }
}