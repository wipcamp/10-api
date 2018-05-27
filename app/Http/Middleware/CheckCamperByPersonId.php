<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\CamperRepository;

class CheckCamperByPersonId
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
        $camper = $camper->getCamperByPersonId($request->route('personId'));
        
        if (array_has($camper[0], 'profile_camper')) {
            return $next($request);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Not A Camper.'
        ]);
    }
}
