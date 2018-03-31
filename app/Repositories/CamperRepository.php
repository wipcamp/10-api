<?php
namespace App\Repositories;

use App\Models\ProfileCamper;

class CamperRepository implements CamperRepositoryInterface {
    public function getCamperByUserId($userId) {
        return ProfileCamper::with('profile')->where('user_id', $userId)->get();
    }

    public function getAllCampers() {
        return ProfileCamper::with('profile')->get();
    }
}