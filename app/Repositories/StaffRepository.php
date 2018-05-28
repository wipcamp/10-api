<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\ProfileStaff;
use App\Models\Profile;

class StaffRepository implements StaffRepositoryInterface {

  public function create($id, $stdId, $flavorId) {
    $staff = new ProfileStaff;
    return $staff->create([
      'user_id' => $id,
      'student_id' => $stdId,
      'section_id' => $flavorId
    ]);
  }

  public function getAll() {
    $staffs = new ProfileStaff;
    return $staffs->with(['user', 'profile'])->get();
  }

  public function getNonApprove() {
    return DB::select(
      '
      SELECT * FROM profile_staffs as ps JOIN users u ON ps.user_id = u.id WHERE ps.user_id NOT IN (SELECT DISTINCT user_id FROM user_roles WHERE role_id >= 6)
      '
    );
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