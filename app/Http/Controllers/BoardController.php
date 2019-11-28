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
        $this->middleware('admin_auth');
    }

    public function notices(Request $request, CommonService $CommonService)
    {
        $MetroList = $CommonService->getMetroList();
        $CircuitList = $CommonService->getCircuitList();
        $ReceiveGroupList = $CommonService->getReceiveGroupList();
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->MetroID,
            $request->CircuitID,
            $request->ReceiveGroupID
        ];
        $data = DB::select('uspGetStandingNoticeList ?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingNoticeListCnt ?,?,?', $parameter);
        $NoticeList = setPaginator($paginate, $page, $data, $count);

        return view('board.notices', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ReceiveGroupList' => $ReceiveGroupList,
            'NoticeList' => $NoticeList
        ]);
    }

    public function detailNotices($id)
    {
        DB::table('Notices')->where('NoticeID', $id)->increment('ReadCnt');
        $Files = DB::select('uspGetStandingNoticeFile ?', [$id]);
        $Notice = DB::select('uspGetStandingNoticeDetail ?', [$id]);

        return view('board.detail_notices', [
            'Files' => $Files,
            'Notice' => $Notice[0]
        ]);
    }

    public function formNotices(CommonService $common)
    {
        $MetroList = $common->getMetroList();
        $ReceiveGroupList = $common->getReceiveGroupList();

        return view('board.formNotices', [
            'MetroList' => $MetroList,
            'ReceiveGroupList' => $ReceiveGroupList
        ]);
    }

    public function putNotices(Request $request, PushService $PushService)
    {   
        $request->validate([
            'ReceiveGroupID' => 'required',
            'Title' => 'required|max:500',
            'Contents' => 'required'
        ]);

        if ($request->Files !== null) {
            $files = [];
            for ($i=0; $i < count( $request->Files ); $i++) { 
                $files[] = [
                    'path' => $request->Files[$i]->store('files'),
                    'name' => $request->Files[$i]->getClientOriginalName()
                ];
            }
        }
        $res = DB::select('uspSetStandingNoticeInsert ?,?,?,?,?,?,?,?', [
            $request->MetroID,
            $request->CircuitID,
            $request->ReceiveGroupID,
            $request->Title,
            $request->Contents,
            $request->DisplayYn,
            session('auth.AdminID'),
            0
        ]);

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
        $PushService->newNotice();

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
