<?php
namespace App\Repositories;
use App\Models\Profile;
use App\Models\ProfileRegistrant;

class ProfileRepository implements ProfileRepositoryInterface {
  protected $profiles;

  public function filterProfile($array) {
    $filtered = array_except($array, [
      'addr_prov', 'addr_dist', 'telno_personal', 
      'edu_name', 'edu_lv', 'edu_major', 'edu_gpax',
      'known_via', 'activities', 'skill_computer', 'past_camp',
      'parent_relation', 'telno_parent'
    ]);
    return $filtered;
  }

  public function filterProfileRegistrant($array) {
    $filtered = array_except($array, [
      'first_name', 'last_name', 'first_name_en', 'last_name_en', 'nickname',
      'gender_id', 'citizen_id', 'religion_id', 'birth_at',
      'blood_group', 'congenital_diseases', 'allergic_foods', 'congenital_drugs'
    ]);
    return $filtered;
  }

  public function create($data) {
    $profile = new Profile($data);
    $profilesRegistrant = new ProfileRegistrant($data);
    $profile->save();
    $profilesRegistrant->save();
    return $data;
  }

  public function createStaff($data) {
    $profile = new Profile($data);
    return $profile->save();
  }
  
  public function update($data) {
    $this->profiles = new Profile;
    $profile = $this->filterProfile($data);
    $this->profiles
      ->where('user_id', $data['user_id'])
      ->update($profile);

    $this->profiles = new ProfileRegistrant;
    $profileRegistrant = $this->filterProfileRegistrant($data);
    $this->profiles
      ->where('user_id', $data['user_id'])
      ->update($profileRegistrant);
    return array_merge($profile, $profileRegistrant);  
  }

  public function get() {
    $this->profiles = new Profile;
    return $this->profiles->get();
  }

  function getProfile($id) {
    $profile = Profile::find($id);
    return $profile;
  }

  public function getRegistrants() {
    $this->profiles = new Profile;
    return $this->profiles->with([
      'profile_registrant',
      'documents',
      'eval_answers'
      ])->get();
  }
  
  public function getRegistrantsById($userId) {
    $this->profiles = new Profile;
    return $this->profiles->with([
      'profile_registrant',
      'documents',
      'eval_answers'
      ])->where('user_id', $userId)->get();
  }

  public function getById($userId) {
    $this->profiles = new Profile;
    return $this->profiles->where('user_id',$userId)->with('profile_registrant')->first();
  }
}