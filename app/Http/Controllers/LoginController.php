<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function view()
    {
        // DB::select('uspSetStandingAdminInsert ?,?,?,?,?,?',
        //     [
        //         'developer', // @Account
        //         '123123', //@UserPassword
        //         '개발자', // @AdminName
        //         1, // @AdminRoleID
        //         0, // @TempUseYn
        //         '010-7224-0578' // @Mobile
        //      ]);
        return view('login');
    }
    public function try_login(Request $request)
    {
        $request->validate([
            'Account' => 'required',
            'UserPassword' => 'required',
        ]);
        try {
            $res = DB::select('uspGetStandingAdminLogIn ?,?',
                [
                    $request->Account, 
                    $request->UserPassword,
                ]);
        } catch (Exception $e) {
                return $e;
        }
        

        if($res){
            $AdminRoleID = $res[0]->AdminRoleID;
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
            session(['auth.AdminRoleID' => $AdminRoleID]);
            session(['gnb' => $gnb]);
            session(['breadcrumb' => $breadcrumb]);
        }
        if(!$res) $ErrorMessage = '로그인에 실패하였습니다. Caps Lock 키가 꺼져 있는지 확인한 뒤 다시 시도하십시오.';
        
        if( isset($ErrorMessage) ) 
            return back()
                ->withInput(Input::except('UserPassword'))
                ->withErrors(['fail' => $ErrorMessage]);
        
        return redirect('/');
        
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
