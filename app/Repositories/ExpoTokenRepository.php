<?php

namespace App\Repositories;

use App\Models\ExpoToken;
use Exception;

class ExpoTokenRepository implements ExpoTokenRepositoryInterface {
    public function getByUserId($userId) {
        $data = ExpoToken::where('user_id', $userId)->get();
        return $data;
    }
    
    public function create($userId, $token) {
        try {
            $expoToken = new ExpoToken;

            $expoToken->user_id = $userId;
            $expoToken->expo = $token;

            $expoToken->save();

            return "true";
        }
        catch(Exception $exception) {
            return "false";
        }
    }
}