<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Repositories\CampRepository;

class CloseRegister
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
        $camp = new CampRepository();
        $currentDate = Carbon::now();
        $closedDate = Carbon::parse($camp->getBySeason(10)[0]->closed_at);
        if ($currentDate < $closedDate) {
            return $next($request);
        }
        return response()->json([
            'data' => 'doge doge doge doge doge',
            'error' => 'closed register.'
        ]);
    }
}
