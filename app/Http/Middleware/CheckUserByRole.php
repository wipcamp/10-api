<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class CheckUserByRole
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
        $user['role'] = 1;
        if ($user['role'] > 2)
            return $next($request);
        return response()->json([
            'error' => 'Invalid Permission.'
        ]);
    }
}
