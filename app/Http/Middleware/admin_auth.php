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
        $auth_path = session('auth.path');              //권한이 있는 path 목록 (array)
        $path_explode = explode('/', $request->path());
        $path = $path_explode[0];                    //서브 path 제거
        
        if( array_search($path, $auth_path) !== false ){ // 요청된 path가 권한이 있는지 확인
            
            view()->share( 'breadcrumb', set_breadcrumb_array($path_explode) );  //모든 뷰파일에 $breadcrumb 바인딩 
            $response = $next($request);
            return $response;

        }
        return redirect('/errors/auth');
  
    }
}
