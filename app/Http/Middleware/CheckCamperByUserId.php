<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Repositories\CamperRepository;

class CheckCamperByUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->toUser()->toArray();
        $campers = new CamperRepository;
        $isPassed = $campers->getCamperByUserId($user['id']);
        
        if (!blank($isPassed)) {
            return $next($request);
        }
        return response()->json([
            'error' => 'Not Passed. :)'
        ]);
    }
}
