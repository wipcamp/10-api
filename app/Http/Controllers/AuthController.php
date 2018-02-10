<?php
namespace App\Http\Controllers;

use Validator;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;
use App\Repositories\ProviderUserRepository;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login() {
        $schema = [
            'id' => 'required',
            'accessToken' => 'required'
        ];
        // get request data
        $credentials = request(['id', 'accessToken']);
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
        } catch (\Exception $e) { }

        if ($res == null) {
            return response()->json(['error' => 'Invalid Facebook Account'], 401);
        }

        $user = new UserRepository;
        $user = $user->getUserProviderByCredentials($credentials['id']);

        $token = auth()->login($user);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

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

    public function getAuthenticatedUser() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
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
