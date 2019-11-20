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
        //         'role5', // @Account
        //         '11112222', //@UserPassword
        //         '롤5', // @AdminName
        //         5, // @AdminRoleID
        //         1, // @TempUseYn
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
        // dd($request->UserPassword);
        if($res === []) $fail = '로그인에 실패하였습니다.<br>Caps Lock 키가 꺼져 있는지 확인한 뒤 다시 시도하십시오.';

        if($res){
            $AdminID = $res[0]->AdminID;
            $AdminName = $res[0]->AdminName;
            $AdminRoleID = $res[0]->AdminRoleID;
            $MetroID = $res[0]->MetroID;
            $CircuitID = $res[0]->CircuitID;
            $CongregationID = $res[0]->CongregationID;
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
            session(['auth.MetroID' => $MetroID]);
            session(['auth.CircuitID' => $CircuitID]);
            session(['auth.CongregationID' => $CongregationID]);
            session(['gnb' => $gnb]);
            session(['breadcrumb' => $breadcrumb]);
        }
     
        if( isset($fail) ) 
            return back()
                ->withInput(Input::except('UserPassword'))
                ->withErrors(['fail' => $fail]);
        else if($TempPassYn === 1)
            return redirect('/SetPwd');
        else
            return redirect('/');
        
        
    }

    public function setPwd()
    {
        return view('setPwd');
    }

    public function putSetPwd(Request $request)
    {
        $request->validate([
            'UserPassword' => 'required|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,12}$/', //8~12자리의 영문, 숫자, 특수문자 포함
        ]);
        $res = DB::select('uspSetStandingAdminPasswordUpdate ?,?',
            [
                session('auth.AdminID'),
                $request->UserPassword,
            ]);
        if(getAffectedRows($res) === 0) 
            return back()
                ->withErrors(['fail' => '비밀번호변경에 실패 했습니다']);
        else
            return redirect('/');
    }

    public function resetPwd()
    {
        return view('resetPwd');
    }

    public function putResetPwd(Request $request)
    {
        $request->validate([
            'Account' => 'required', //8~12자리의 영문, 숫자, 특수문자 포함
            'Mobile' => 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
        ]);

        $res = DB::select('uspSetStandingAdminPasswordReset ?,?',
            [
                $request->Account,
                $request->Mobile,
            ]);

        if(getAffectedRows($res) === 0) 
            return back()
                ->withErrors(['fail' => '비밀번호 초기화에 실패하였습니다. <br> 아이디 혹은 휴대폰번호를 확인해주세요.']);
        else
            return redirect('/login')
                ->with(['message' => $request->Account . '(아이디)의 비밀번호가 "11112222"로 변경되었습니다.']);
        
    }


}
