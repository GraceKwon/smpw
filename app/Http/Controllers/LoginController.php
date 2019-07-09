<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function try_login()
    {
        $AdminRoleID = 1;
        $admin_auth = config('admin_auth');
        $gnb = [];

        foreach ($admin_auth as $key => $main) {
            
            $title = $main['title'];
            
            foreach ($main['submenus'] as $key => $submenus) {
                if( array_search($AdminRoleID ,$submenus['auth']) !== false){
                    $gnb[$title][$key] = $submenus['name'];
                };
            }
        }
        session(['gnb' => $gnb]);

        return view('/login');
    }
}
