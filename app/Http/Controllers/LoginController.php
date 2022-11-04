<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
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
            $AdminID = $res[0]->AdminID ? (int)$res[0]->AdminID : null;
            $AdminName = $res[0]->AdminName;
            $AdminRoleID = $res[0]->AdminRoleID ? (int)$res[0]->AdminRoleID : null;
            $MetroID = $res[0]->MetroID ? (int)$res[0]->MetroID : null;
            $CircuitID = $res[0]->CircuitID ? (int)$res[0]->CircuitID : null;
            $CongregationID = $res[0]->CongregationID ? (int)$res[0]->CongregationID : null;
            $TempPassYn = $res[0]->TempPassYn ? (int)$res[0]->TempPassYn : null;
            $PublisherNumber = $res[0]->PublisherNumber ? (int)$res[0]->PublisherNumber : 6;
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
            session(['auth.PublisherNumber' => $PublisherNumber]);
            session(['gnb' => $gnb]);
            session(['breadcrumb' => $breadcrumb]);
        }

        if( isset($fail) )
            return back()
                ->withInput()
                ->withErrors(['fail' => $fail]);
        else if( $TempPassYn === 1)
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
        $Password = sprintf('%04d',rand(0, 9999));
        $msg = '대도시 특별 공개증거 아이디 '.$request->Account.' 의 비밀번호가 변경 되었습니다. 초기화 비밀번호는 '.$Password.' 입니다.';

        try {
            $res = DB::select('uspSetStandingAdminPasswordReset ?,?,?',
                [
                    $request->Account,
                    $request->Mobile,
                    $Password
                ]);

            if(getAffectedRows($res) === 0) {
                return back()
                    ->withErrors(['fail' => '비밀번호 초기화에 실패하였습니다. <br> 아이디 혹은 휴대폰번호를 확인해주세요.']);
            }
            else {
                $client = new Client();

                $body = [
                    "version" => "1.0",
                    "from" => "01087918350",
                    "to" => [$request->Mobile],
                    "text" => $msg,
                    "date" => "null"
                ];

                $key = env('SMS_API_KEY').'&'.env('SMS_AUTH_KEY');
                $response = $client->request('POST', env('SMS_HOST'), [
                    'headers' => [
                        'Content-Type' => 'application/json;charset=UTF-8',
                        'secret' => base64_encode($key),
                    ],
                    'body' => json_encode($body),
                ])->getBody();

                $result = json_decode($response);

                if ($result->resultCode === 0) {
                    return redirect('/login')
                        ->with(['message' => $request->Account . '(아이디)의 비밀번호가 "' . $Password . '"로 변경되었습니다.']);
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
//            return false;
        }

    }


}
