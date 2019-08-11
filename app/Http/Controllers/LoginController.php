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
        $breadcrumb = [];
        foreach ($admin_auth as $key => $main) {
            
            $title = $main['title'];
            
            foreach ($main['submenus'] as $path => $submenus) {
                if( array_search($AdminRoleID ,$submenus['auth']) !== false ){
                    $gnb[$title][$path] = $submenus['name'];
                    $auth_path[] = $path;
                    
                    $breadcrumb[$path] = [ 
                        [ 
                            'path' => null, 
                            'name' => $title
                        ],
                        [
                            'path' => $path,
                            'name' => $submenus['name']
                        ]
                    ];
                    if( isset($submenus['subpage']) ){
                        $breadcrumb[$path][] = [
                            'path' => null,
                            'name' => $submenus['subpage']
                        ];
                    }
                };
            }
        }
        //세션 주입
        session(['auth.path' => $auth_path]);
        session(['gnb' => $gnb]);
        session(['breadcrumb' => $breadcrumb]);
        return view('/login');
    }

    public function view_reset_pwd()
    {
        return view('reset_pwd');
    }

    public function view_set_pwd()
    {
        return view('set_pwd');
    }
}
