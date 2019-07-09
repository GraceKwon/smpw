<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
    public function try_login()
    {
        $AdminRoleID = 1;
        $admin_auth = config('admin_auth');
        $gnb = [];
        $auth_path = [];

        foreach ($admin_auth as $key => $main) {
            
            $title = $main['title'];
            
            foreach ($main['submenus'] as $path => $submenus) {
                if( array_search($AdminRoleID ,$submenus['auth']) !== false){
                    $gnb[$title][$path] = $submenus['name'];
                    $auth_path[] = $path;
                };
            }
        }
        
        session(['auth.path' => $auth_path]);
        session(['gnb' => $gnb]);

        return view('/login');
    }
}
