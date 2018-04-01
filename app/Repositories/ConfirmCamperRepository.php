<?php
namespace App\Repositories;

use App\Models\ConfirmCamper;

class ConfirmCamperRepository implements ConfirmCamperRepositoryInterface {
    public function getConfirmCamperByUserId($userId) {
        return ConfirmCamper::with('profile')->where('user_id', $userId)->get();
    }

    public function getAllConfirmCampers() {
        return ConfirmCamper::with('profile')->get();
    }

    public function insertConfirmCamper($camper) {
        return ConfirmCamper::insert($camper);
    }
}