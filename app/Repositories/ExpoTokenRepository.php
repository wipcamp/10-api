<?php

namespace App\Repositories;

use App\Models\ExpoToken;

class ExpoTokenRepository implements ExpoTokenRepositoryInterface {
    public function create($userId, $token) {
        $expoToken = new ExpoToken;

        $expoToken->user_id = $userId;
        $expoToken->expo = $token;

        $expoToken->save();

        return "true";
    }
}