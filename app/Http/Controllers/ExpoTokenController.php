<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ExpoTokenRepositoryInterface;

class ExpoTokenController extends Controller
{
    protected $expoRepo;

    public function __construct(ExpoTokenRepositoryInterface $expo) {
        $this->expoRepo = $expo;
    }

    public function createToken(Request $request) {
        $data = $request->all();

        $user_id = array_get($data, 'user_id');
        $token = array_get($data, 'expo');

        $result = $this->expoRepo->create($user_id, $token);

        return json_encode($result);
    }
}
