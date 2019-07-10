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
        $path_count = count($path_explode);             // path 레벨 확인
        if($path_count > 1){                           //서브페이지가 있으면
            $subpage_index = (int)$path_explode[1];   //"0"이 아닌 숫자가 들어왔을때 1로 변환, (int) "0" or "문자열" return 0,
            
            if($subpage_index){   // "0"아닌 숫자면 모두 1로 치환
                $subpage_index = 1;
            }
        }
        $breadcrumb = session('breadcrumb')[$path];     // rending breadcrumb array
        $breadcrumb = array_splice($breadcrumb, 0, $path_count + 1); // $breadcrumb = ['메뉴', '서브메뉴', '서브페이지']
        if( isset($breadcrumb[2]) && isset($subpage_index) ){
            if( count( $breadcrumb[2] ) > 1 ){
                $breadcrumb[2] = $breadcrumb[2][$subpage_index];
            }else{
                $breadcrumb[2] = $breadcrumb[2][0];
            }
        }
        if( array_search($path, $auth_path) !== false ){ // 요청된 path가 권한이 있는지 확인
        
            view()->share( 'breadcrumb', $breadcrumb );  //모든 뷰파일에 $breadcrumb 바인딩 
            $response = $next($request);
            return $response;

        }

        return redirect('/auth_error');
  
    }
}
