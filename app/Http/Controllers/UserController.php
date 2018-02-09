<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use JWTAuthException;
use Validator;

use App\Repositories\UserRepository;

class UserController extends Controller
{

    public function __construct() {
        $this->user = new UserRepository;
    }

    public function create(Request $request) {
        $schema = [
            'id' => 'required',
            'name' => 'required',
            'accessToken' => 'required',
            'picture' => 'required',
            'expiresIn' => 'required',
        ];
        // get data
        $data = $request->all();
        // validate
        $validator = Validator::make($data, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => $this->user->create($data)
        ]);
    }

    public function getAuthUser(Request $request) {
        $user = JWTAuth::toUser($request->token);        
        return response()->json([
            'status' => 200,
            'data' => $user
        ]);
    }

    public function getByProviderAcc($providerAcc) {
        $user = new UserRepository;
        return response()->json([
            'status' => 200,
            'data' => $user->getByProviderAcc($providerAcc)
        ]);
      }

}