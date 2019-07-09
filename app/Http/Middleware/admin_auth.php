<?php

namespace App\Http\Middleware;

use Closure;

class admin_auth
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
        $auth_path = session('auth.path');
        $path = $request->path();
        $path  = explode('/', $path)[0];
    
        if( array_search($path, $auth_path) !== false){

            return $next($request);
        }
        return redirect('/error' . $auth_path[0]);
  
    }
}
