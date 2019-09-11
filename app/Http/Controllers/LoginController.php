<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function login()
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
    public function logOut()
    {
        session()->flush();

        return redirect('/login');
    }
    public function tryLogin(Request $request)
    {
        /* 파라미터 유효성 체크 */
        $request->validate([
            'Account' => 'required',
            'UserPassword' => 'required',
        ]);

        /*프로시져 호출*/
        $res = DB::select('uspGetStandingAdminLogIn ?,?',
            [
                $request->Account, 
                $request->UserPassword,
            ]);
        
        if($res === []) $fail = '로그인에 실패하였습니다.<br>Caps Lock 키가 꺼져 있는지 확인한 뒤 다시 시도하십시오.';

        if($res){
            $AdminID = $res[0]->AdminID;
            $AdminName = $res[0]->AdminName;
            $AdminRoleID = $res[0]->AdminRoleID;
            $TempPassYn = $res[0]->TempPassYn;
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
            session(['auth.AdminID' => $AdminID]);
            session(['auth.AdminName' => $AdminName]);
            session(['auth.AdminRoleID' => $AdminRoleID]);
            session(['gnb' => $gnb]);
            session(['breadcrumb' => $breadcrumb]);
        }
     
        if( isset($fail) ) {
            return back()
                ->withInput(Input::except('UserPassword'))
                ->withErrors(['fail' => $fail]);
        }else if($TempPassYn === 1){
            return redirect('/first');
        }else{
            return redirect('/');
        }
        
    }

    public function setPwd()
    {
        return view('setPwd');
    }

    public function putSetPwd(Request $request)
    {
        // dd($request->UserPassword);
        $request->validate([
            'UserPassword' => 'required|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,12}$/', //8~12자리의 영문, 숫자, 특수문자 포함
        ]);
        $res = DB::select('uspSetStandingAdminPasswordUpdate ?,?,?',
            [
                session('auth.AdminID'),
                '11112222',
                $request->UserPassword,
            ]);
        // dd($res);
        return redirect('/');
    }

    public function resetPwd()
    {
        return view('resetPwd');
    }

    public function putResetPwd(Request $request)
    {
        $res = DB::select('uspSetStandingAdminPasswordReset ?,?',
            [
                $request->Account,
                $request->Mobile,
            ]);
        // dd($res);
        return redirect('/login');
    }


}
