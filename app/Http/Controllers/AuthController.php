<?php

namespace App\Http\Controllers;

use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Repositories\ProviderUserRepository;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function login(Request $request) {
        // get request
        $facebookId = $request['id'];
        $accessToken = $request['accessToken'];
        
        // custom auth
        // get user
        $user = new ProviderUserRepository;
        $user = $user->getUserProviderByCredentials($facebookId, $accessToken);
        
        // create token
        $payload = JWTFactory::sub($user->user_id)->
            userId($user->user_id)->
            accountName($user->account_name)->
            make();
        $token = JWTAuth::encode($payload);

        // response
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token->get());
    }
    
    public function me() {
        return response()->json(auth()->user());
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token) {
        $data = [
            'accessToken' => $token,
            'type' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * 144000
        ];
        return response()->json($data);
    }
}
