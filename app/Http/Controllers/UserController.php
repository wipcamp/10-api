<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use JWTAuthException;

use App\Repositories\UserRepository;

class UserController extends Controller
{

    public function __construct() {
        $this->user = new UserRepository;
    }

    public function create(Request $request) {
        return $this->user->create($request->all());
    }
    
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
            ],
        ]);
    }

    public function getAuthUser(Request $request) {
        $user = JWTAuth::toUser($request->token);        
        return response()->json(['result' => $user]);
    }

    public function getByProviderAcc($providerAcc) {
        $user = new UserRepository;
        return response()->json([
            'status' => '200',
            'data' => $user->getByProviderAcc($providerAcc),
        ]);
      }

}