<?php
namespace App\Repositories;

use App\Models\Profile;
use App\Models\ProfileCamper;

class CamperRepository implements CamperRepositoryInterface {
    public function getCamperByUserId($userId) {
        return ProfileCamper::with(['profile', 'profile_registrant', 'confirm_camper'])->where('user_id', $userId)->get();
    }

    public function getCamperByPersonId($personId) {
        return Profile::with(['profile_registrant', 'profile_gender', 'profile_religion', 'profile_camper'])->where('citizen_id', $personId)->get();
    }

    public function getAllCampers() {
        return ProfileCamper::with(['profile', 'profile_registrant', 'confirm_camper'])->get();
    }

    public function updateFlavor($userId, $sectionId) {
        return ProfileCamper::where('user_id', $userId)
        ->update(['section_id' => $sectionId]);
    }
    
    public function updateCheckin($userId, $checkedAt) {
        return ProfileCamper::where('user_id', $userId)
        ->update(['checked_at' => $checkedAt]);
    }
}