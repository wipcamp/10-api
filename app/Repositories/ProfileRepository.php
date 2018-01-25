<?php
namespace App\Repositories;
use App\Models\Profile;
use App\Models\ProfileRegistrant;

class ProfileRepository implements ProfileRepositoryInterface {
  protected $profiles;

  public function __construct(){
    $this->profiles = new Profile;
  }

  public function create($data) {
    $this->profiles = new Profile($data);
    $result = $this->profiles->save();
    if ($result) {
      $profilesRegistrant = new ProfileRegistrant($data);
      $result = $this->profiles->profile_registrant()->save($profilesRegistrant);
    }
    return json_encode(['result' => $result]);
  }
}