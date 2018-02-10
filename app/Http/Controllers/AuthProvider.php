<?php

namespace App\Http\Controllers;

use Validator;

class AuthProvider
{
    public function Authentication($credentials) {
        $schema = [
            'id' => 'required',
            'accessToken' => 'required'
        ];
        // get request data
        // validate
        $validator = Validator::make($credentials, $schema);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $URL = "https://graph.facebook.com/me?access_token=${credentials['accessToken']}";
        $client = new \GuzzleHttp\Client;
        $res = null;
        try {
            $res = $client->get($URL);
            $res = (string) $res->getBody();
            $res = json_decode($res, true);
        } catch (\Exception $e) { }
        
        if ($res == null) {
            return response()->json(['error' => 'Invalid Facebook Account']);
        }

        return true;
    }
}