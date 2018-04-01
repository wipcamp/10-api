<?php
namespace App\Repositories;

use App\Models\ProfileCamper;

class CamperRepository implements CamperRepositoryInterface {
    public function getCamperByUserId($userId) {
        return ProfileCamper::with(['profile_registrant', 'confirm_camper'])->where('user_id', $userId)->get();
    }

    public function getAllCampers() {
        return ProfileCamper::with(['profile_registrant', 'confirm_camper'])->get();
    }
}