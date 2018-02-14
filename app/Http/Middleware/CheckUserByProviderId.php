<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class CheckUserByProviderId
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
        if ($user['provider_acc'] === $request['providerAcc'])
            return $next($request);
        return response()->json([
            'error' => 'Invalid User.'
        ]);
    }
}
