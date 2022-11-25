<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\PublisherService;
use Illuminate\Support\Facades\Log;
use App\Service\PushService;

class PublisherController extends Controller
{
    public function __construct(CommonService $CommonService, PushService $PushService)
    {
        $this->CommonService = $CommonService;
        $this->PushService = $PushService;
        $this->middleware('admin_auth');
    }

    public function publishers(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
// dd(session('auth.AdminRoleID'));
        $paginate = 30;
        $page = $request->input('page', '1');
        $getLocal = App::getLocale();
        $parameter = [
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            $request->CongregationID,
            $request->PublisherName,
            $request->Gender,
            $request->ServantTypeID,
            $request->UseYn,
        ];
        $data = DB::select('uspGetStandingPublisherList ?,?,?,?,?,?,?,?,?',
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingPublisherListCnt ?,?,?,?,?,?,?', $parameter);

        $PublisherList = setPaginator($paginate, $page, $data, $count);
        // dd($PublisherList);
        return view( 'publisher.publishers', [
            'PublisherList' => $PublisherList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
            'getLocal' => $getLocal,
        ]);
    }

    public function formPublishers(Request $request, PublisherService $PublisherService)
    {
        if( $request->PublisherID !== '0' ) {
            $res = DB::select( 'uspGetStandingPublisherDetail ?', [
                $request->PublisherID
                ]);
                $Publisher = reset($res); /* reset( [] ) === false */
                if( empty($Publisher) ) abort(404); /* empty( false ) === true */

                $request->CircuitID = $Publisher->CircuitID;
            }

         // For서울지역 조정장로 봉사자등록 대응
        if(session('auth.MetroID') === 1){
            $CongregationList = $this->CommonService->getMetroCongregationList();

        } else {
            $CongregationList = $this->CommonService->getCongregationList();
        }
        // For서울지역 조정장로 봉사자등록 대응

        $ServantTypeList = $this->CommonService->getServantTypeList();
        $PioneerTypeList = $this->CommonService->getPioneerTypeList();
        $EndTypeIDList = $this->CommonService->getEndTypeList();

        $ServiceZoneList = $this->CommonService->getServiceZoneList();
        $ServiceTimeList = $PublisherService->getServiceTimeList();

        $SetTimeCount = $PublisherService->getServiceYoilSetTimeCount();
        // dd($SetTimeCount);
//        dd($Publisher);
        return view('publisher.formPublisher', [
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
            'PioneerTypeList' => $PioneerTypeList,
            'EndTypeIDList' => $EndTypeIDList,
            'Publisher' => $Publisher ?? null,
            'ServiceZoneList' => $ServiceZoneList,
            'ServiceTimeList' => $ServiceTimeList,
            'SetTimeCount' => $SetTimeCount,
        ]);
    }

    public function putPublishers(Request $request)
    {
        $request->validate([
            'PublisherName' => 'required',
            'CongregationID' => 'required',
            'Gender' => 'required',
            'Mobile' => 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
            'PioneerTypeID' => 'required',
            'ServantTypeID' => 'required',
            'SupportYn' => 'required',
//            'EndDate' => $request->StopYn === '1' ? 'required' : '' . '|date',
//            'EndTypeID' => $request->StopYn === '1' ? 'required' : '',
        ]);

        try {
            if($request->PublisherID === '0') {
                $password = sprintf('%04d',rand(0,9999));
                $res = DB::select('uspSetStandingPublisherInsert ?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    $request->PublisherName,
                    $password,//$request->UserPassword,
                    $request->CongregationID,
                    $request->Gender,
                    $request->Mobile,
                    40,//$request->MobileOsKindID,
                    $request->PioneerTypeID,
                    $request->ServantTypeID,
                    1,//$request->UseYn,
                    $request->SupportYn,
                    $request->Memo,
                    $request->EndDate,
                    $request->EndTypeID,
                ]);

                $msg = '[대특공]봉사자로 등록되었습니다. 아이디: '.trim($res[0]->pId).
                    ' 입니다. 임시 비밀번호: '.$password. '입니다. [대특공] 앱 설치 주소 입니다.';
                $this->sendSms($request->Mobile, $msg);
                sleep(3);
                $addressLink = 'https://smpw.or.kr/home/appdownload';
                $result = $this->sendSms($request->Mobile, $addressLink);
                if ($result->resultCode !== 0) {
                    Log::error('봉사자 등록 문자 발송 에러');
                    Log::error('에러 메시지 ===== '.$result);
                }

                $code = getAffectedRows($res) === 0 ? 1 : getAffectedRows($res);
            } else {
                $res = DB::select('uspSetStandingPublisherUpdate ?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    $request->PublisherID,
                    $request->PublisherName,
                    $request->CongregationID,
                    $request->Gender,
                    $request->Mobile,
                    40,
                    $request->PioneerTypeID,
                    $request->ServantTypeID,
                    $request->StopYn,
//                    $request->StopYn === '1' ? 0 : 1,
                    $request->SupportYn,
                    $request->Memo,
                    $request->EndDate,
                    $request->EndTypeID,
                ]);

                $code = getAffectedRows($res);
            }

            if($code === 0) {
                return back()->withErrors(['fail' => '저장 실패하였습니다.'])->withInput();
            } else {
                return redirect('/publishers');
            }
        } catch (\Exception $e) {
            Log::error('봉사자 등록 및 수정 에러 ========== '.$e);
        }

    }

    public function deletePublishers(Request $request)
    {
        $res = DB::select('uspSetStandingPublisherDelete ?,?', [
                $request->PublisherID,
                0,
            ]);

        if( getAffectedRows($res) === 0 )
            return back()->withErrors(['fail' => '삭제 실패하였습니다.']);
        else
            return redirect('/publishers');

    }

    public function resetPwdPublishers(Request $request)
    {
        try {
            $res = DB::select('uspSetPublisherPasswordReset ?,?', [
                $request->PublisherID,
                $Password = sprintf('%04d',rand(0,9999)),
            ]);

            if( getAffectedRows($res) === 0 ) {
                return back()->withErrors(['fail' => '비밀번호 초기화를 실패하였습니다.']);
            } else {
                $msg = '대도시 공개 증거 '.$request->Account.' 계정의 임시 비밀번호가 발급되었습니다. 임시비밀번호는 '. $Password.'입니다.';
                $result = $this->sendSms($request->Mobile, $msg);

                if ($result->resultCode === 0) {
                    return back()->with(['success' => '비밀번호 초기화를 성공하였습니다. 임시비밀번호는 '. $Password.'입니다']);
                }
            }
        } catch (\Exception $e) {
            Log::error('비밀번호 초기화 에러 === '.$e);
        }
    }

    public function putServiceTimePublieher(Request $request)
    {
        $request->validate([
            'SetStartDate' => 'required|date',
            ]);
            $ServiceSetType = $request->ServiceSetType;
            $PublisherID = $request->PublisherID;
            $SetStartDate = $request->SetStartDate;
            // DB::transaction(function() use ($ServiceSetType, $PublisherID, $SetStartDate)
            // {
            $arrayForPush = [];
            foreach ($ServiceSetType as $ServiceTimeID => $ServiceSetType) {
                DB::statement('uspSetStandingServiceTimePublieherDelete ?,?,?', [
                        $PublisherID,
                        $ServiceTimeID,
                        $SetStartDate
                    ]);

                if($ServiceSetType !== '미지정'){
                    $arrayForPush[$ServiceTimeID]["ServiceSetType"] = $ServiceSetType;

                    DB::statement('uspSetStandingServiceTimePublieherInsert ?,?,?,?,?', [
                        $PublisherID,
                        $ServiceTimeID,
                        ($ServiceSetType ==='인도자') ? 1 : 0,
                        ($ServiceSetType ==='대기') ? 1 : 0,
                        $SetStartDate,
                        ]);
                }
            }
            // });
            if(!empty($arrayForPush)){

                foreach ($arrayForPush as $ServiceTimeID => $ServiceSetType) {

                    $res =  DB::table('ServiceTimes')
                    ->select(
                        'ServiceTimes.ServiceTime',
                        'ServiceTimes.ServiceYoil',
                        'ServiceZones.ZoneName'
                        )
                        ->where([
                            ['ServiceTimes.ServiceTimeID', $ServiceTimeID],
                            ])
                            ->leftJoin('ServiceZones', 'ServiceTimes.ServiceZoneID', 'ServiceZones.ServiceZoneID')
                            ->first();
                    $arrayForPush[$ServiceTimeID]["ServiceTime"] = $res->ServiceTime;
                    $arrayForPush[$ServiceTimeID]["ServiceYoil"] = $res->ServiceYoil;
                    $arrayForPush[$ServiceTimeID]["ZoneName"] = $res->ZoneName;
                }
                // dd($arrayForPush);
                $this->PushService->PublisherServiceTimeSet($arrayForPush);
            }
        // dd($request->all());
        return back();

    }

    private function sendSms($mobile, $msg) {
        $client = new Client();

        $body = [
            "version" => "1.0",
            "from" => "01087918350",
            "to" => [$mobile],
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

        return json_decode($response);
    }



}
