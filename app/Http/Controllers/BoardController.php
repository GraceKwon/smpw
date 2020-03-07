<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Service\CommonService;
use App\Service\PushService;
use DB;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth')->except('fileDownload');
    }

    public function notices(Request $request, CommonService $CommonService)
    {
        $MetroList = $CommonService->getMetroList();
        $CircuitList = $CommonService->getCircuitList();
        $ReceiveGroupList = $CommonService->getReceiveGroupList('list');
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->MetroID,
            $request->CircuitID,
            $request->ReceiveGroupID,
            session('auth.AdminRoleID')
        ];
        
        if (session('auth.MetroID')) $parameter[0] = session('auth.MetroID');
        if (session('auth.CircuitID')) $parameter[1] = session('auth.CircuitID');
        $data = DB::select('uspGetStandingNoticeList ?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingNoticeListCnt ?,?,?,?', $parameter);
        $NoticeList = setPaginator($paginate, $page, $data, $count);

        return view('board.notices', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ReceiveGroupList' => $ReceiveGroupList,
            'NoticeList' => $NoticeList
        ]);
    }

    public function detailNotices($id, Request $request)
    {
        $modify = false;
        $parameter = [
            $id,
            $request->MetroID,
            $request->CircuitID,
            $request->ReceiveGroupID,
            session('auth.AdminRoleID')
        ];

        $noticePre = DB::select('uspGetStandingNoticePre ?,?,?,?,?', $parameter);
        $noticeNext = DB::select('uspGetStandingNoticeNext ?,?,?,?,?', $parameter);
        // dd($noticeNext);
        DB::table('Notices')->where('NoticeID', $id)->increment('ReadCnt');
        $Files = DB::select('uspGetStandingNoticeFile ?', [$id]);
        $Notice = DB::select('uspGetStandingNoticeDetail ?', [$id]);

        if (session('auth.AdminRoleID') == 1 || session('auth.AdminRoleID') == 2) $modify = true;
        if (session('auth.CircuitID') == null && session('auth.MetroID') == $Notice[0]->MetroID) $modify = true;
        if (session('auth.MetroID') == $Notice[0]->MetroID && session('auth.CircuitID') == $Notice[0]->CircuitID) $modify = true;
        if (session('auth.AdminRoleID') == 3 && $Notice[0]->ReceiveGroupID == 41) $modify = false;
        if (session('auth.AdminRoleID') == 5 && ($Notice[0]->ReceiveGroupID == 41 || $Notice[0]->ReceiveGroupID == 42)) $modify = false;
        if (session('auth.AdminRoleID') == 4 && ($Notice[0]->ReceiveGroupID == 41 || $Notice[0]->ReceiveGroupID == 42|| $Notice[0]->ReceiveGroupID == 50)) $modify = false;
        
        /*
        IF @MetroID IS NOT NULL BEGIN 														   
            SELECT @sql = @sql + N' AND n.MetroID = @sMetroID		     	           '
        END
                                                                
        IF @CircuitID IS NOT NULL BEGIN 													   
            SELECT @sql = @sql + N' AND (n.CircuitID = @sCircuitID OR n.CircuitID IS NULL)				     	       '
        END
                                            
        IF @ReceiveGroupID IS NOT NULL BEGIN 												   
            SELECT @sql = @sql + N' AND n.ReceiveGroupID = @sReceiveGroupID			           '
        END
        ELSE BEGIN
            IF @AdminRoleID = 5 BEGIN 												   
                SELECT @sql = @sql + N' AND n.ReceiveGroupID IN (42, 50, 43)	                 '
            END
            IF @AdminRoleID = 4 BEGIN 												   
                SELECT @sql = @sql + N' AND n.ReceiveGroupID IN (50, 43)	                 '
            END
        END
        */
 
        return view('board.detailNotices', [
            'Files' => $Files,
            'Notice' => $Notice[0],
            'modify' => $modify,
            'noticePre' => $noticePre,
            'noticeNext' => $noticeNext,
        ]);
    }

    public function formNotices($id, CommonService $common)
    {
        //TODO : 본인글이 아니면 제한 로직 추가
 
        $Notice = DB::select('uspGetStandingNoticeDetail ?', [$id]);
        $Files = DB::select('uspGetStandingNoticeFile ?', [$id]);

        // dd(json_encode($Files));
        $MetroList = $common->getMetroList();
        $ReceiveGroupList = $common->getReceiveGroupList('form');

        return view('board.formNotices', [
            'Files' => json_encode($Files),
            'Notice' => $Notice,
            'MetroList' => $MetroList,
            'ReceiveGroupList' => $ReceiveGroupList
        ]);
    }

    public function putNotices($id, Request $request, PushService $PushService)
    {   
        $request->validate([
            'MetroID' => 'required',
            'ReceiveGroupID' => 'required',
            'Title' => 'required|max:500',
            'Contents' => 'required'
        ]);

        $delFiles =  explode(',', $request->delFiles);
        for ($i=0; $i < count($delFiles); $i++) { 
            DB::statement('uspSetStandingNoticeFileDelete ?',[$delFiles[$i]]);
        }

        if ($request->Files !== null) {
            $files = [];
            for ($i=0; $i < count( $request->Files ); $i++) { 
                $files[] = [
                    'path' => $request->Files[$i]->store('files'),
                    'name' => $request->Files[$i]->getClientOriginalName()
                ];
            }
        }

        $parameter = [
            $request->MetroID,
            $request->CircuitID,
            $request->ReceiveGroupID,
            $request->Title,
            $request->Contents,
            $request->DisplayYn,
            $request->AdminID,
            $request->ReadCnt
        ];

        if ($id > 0) {
            array_unshift($parameter, $request->NoticeID);
            $res = DB::select('uspSetStandingNoticeUpdate ?,?,?,?,?,?,?,?,?', $parameter);
        }

        if ($id == 0) $res = DB::select('uspSetStandingNoticeInsert ?,?,?,?,?,?,?,?', $parameter);
        
        // $ID = $res[0]->computed; 이렇게하면 윈도우서버에서 오류납니다. 아래코드로 수정함
        $ID = getAffectedRows($res);
        if ($request->Files !== null) {
            foreach($files as $file)
            {
                Storage::move($file['path'], 'notice/'.$ID.'/'.$file['name']);
                DB::select('uspSetStandingNoticeFileInsert ?,?', [
                    $ID,
                    $file['name']
                ]);
            }
        }

        if($request->CircuitID && (int)$request->ReceiveGroupID === (int)getItemID('봉사자전체' , 'ReceiveGroupID')) 
        
        if ($id == 0) {
            $request->NoticeID = $ID; //PushService->sendToTopic에서 사용
            $PushService->newNotice(); //푸시발송
        }

        return;

    }

    public function deleteNotices($id)
    {
        DB::statement('uspSetStandingNoticeDelete ?',[$id]);
        return;
    }

    public function fileDownload($id, $fid)
    {
        $FilePath = DB::table('NoticeFiles')
            ->where('NoticeFileID', $fid)
            ->value('FilePath');

        return Storage::download('notice/'.$id.'/'.$FilePath);
    }
}
