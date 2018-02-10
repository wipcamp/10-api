<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class CheckUserByUserId
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
        if ($user['id'] == $request['userId'])
            return $next($request);
        return response()->json([
            'error' => 'Invalid User.'
        ]);
    }
}
