<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\CamperRepository;

class CheckCheckinByUserId
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
        $camper = new CamperRepository;
        $camper = $camper->getCamperByUserId($request->route('userId'));
        
        if (blank($camper[0]->checked_at)) {
            return $next($request);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Already Check-in.'
        ]);
    }
}
