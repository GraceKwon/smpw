<?php

namespace App\Http\Middleware;

use Closure;

class CheckCircuitID
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
        if( session('auth.CircuitID') ){ 
            
            $response = $next($request);
            return $response;

        }
        return redirect('/errors/auth');
    }
}
