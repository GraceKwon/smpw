<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Service\CommonService;
use DB;

class BoardController extends Controller
{
    public function view_notices()
    {
        return view('board.notices');
    }

    public function view_detail_notices()
    {
        return view('board.detail_notices');
    }

    public function view_form_notices(CommonService $common)
    {
        $MetroList = $common->getMetroList();
        $ReceiveGroupList = $common->getReceiveGroupList();
        return view('board.form_notices', [
            'MetroList' => $MetroList,
            'ReceiveGroupList' => $ReceiveGroupList
        ]);
    }

    public function postForm($id, Request $request)
    {   
        $request->validate([
            'ReceiveGroupID' => 'required',
            'Title' => 'required|max:500',
            'Contents' => 'required',
            'Files' => 'file'
        ]);
        $files = [];
        for ($i=0; $i < count( $request->Files ); $i++) { 
            $files[] = [
                'path' => $request->Files[$i]->store('files'),
                'name' => $request->Files[$i]->getClientOriginalName()
            ];
        }
        // return storage_path();
        /*
        @MetroID int 
        @CircuitID int
        @ReceiveGroupID int
        @Title nvarchar(500) 
        @Contents nvarchar(max)
        @DisplayYn bit 
        @AdminID int 
        @ReadCnt int 
        */
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
        $ID = $res[0]->computed;

        foreach($files as $file)
        {
            Storage::move($file['path'], 'notice/'.$ID.'/'.$file['name']);
            DB::select('uspSetStandingNoticeFileInsert ?,?', [
                $ID,
                $file['name']
            ]);
        }

    }
}
