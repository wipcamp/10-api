<?php
namespace App\Repositories;

use App\Models\ProfileStaff;
use App\Models\Profile;

class StaffRepository implements StaffRepositoryInterface {

  public function create($id, $stdId) {
    $staff = new ProfileStaff;
    return $staff->create([
      'user_id' => $id,
      'student_id' => $stdId
    ]);
  }

  public function getAll() {
    $staffs = new ProfileStaff;
    return $staffs->with(['user', 'profile'])->get();
  }

  public function getStaff($id) {
    $staff = new ProfileStaff;
    return $staff->where('user_id', $id)->first();
  }

  public function update($id, $section){
    $staff = new ProfileStaff;
    return $staff->update([
      'user_id' => $id,
      'section_id' => $section
    ]);
  }

}