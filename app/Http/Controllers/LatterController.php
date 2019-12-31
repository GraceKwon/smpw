<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class LatterController extends Controller
{
    public function view_inbox(Request $request)
    {
        explodeRequestCreateDate();
        if (session('auth.AdminRoleID') > 2) request()->ReceiveAdminID = session('auth.AdminID');
        $AdminList = DB::table('Admins')
            ->when(session('auth.AdminRoleID') > 2, function ($query, $role) {
                return $query->where('AdminRoleID', 2);
            })
            ->get();
        $ReceiveAdminID = DB::table('Admins')
            ->when(session('auth.AdminRoleID') > 2, function ($query, $role) {
                return $query->where('AdminID', session('auth.AdminID'));
            })
            ->get();
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->AdminID,
            $request->ReceiveAdminID,
            $request->StartDate,
            $request->EndDate,
            $request->ReadYn
        ];

        $data = DB::select('uspGetStandingLetterReceiveList ?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingLetterReceiveListCnt ?,?,?,?,?', $parameter);
        $LetterList = setPaginator($paginate, $page, $data, $count);

        return view('latter.inbox', [
            'AdminList' => $AdminList,
            'ReceiveAdminID' => $ReceiveAdminID,
            'LetterList' => $LetterList
        ]);
    }

    public function view_detail_inbox($id)
    {
        $letter = DB::select('uspGetStandingLetterDetail ?', [$id]);
        $Files = DB::select('uspGetStandingLetterFile ?', [$id]);

        if ($letter[0]->ReceiveAdminID == session('auth.AdminID')) {
            DB::table('Letters')
                ->where('LetterID', $id)
                ->update([
                    'ReadYn' => 1,
                    'ReceiveDate' => date('Y-m-d H:i:s')
                ]);
        }

        return view('latter.detail_inbox', [
            'letter' => $letter[0],
            'Files' => $Files 
        ]);
    }

    public function view_sent(Request $request)
    {
        explodeRequestCreateDate();
        if (session('auth.AdminRoleID') > 2) request()->AdminID = session('auth.AdminID');
        
        $AdminList = DB::table('Admins')
            ->when(session('auth.AdminRoleID') > 2, function ($query, $role) {
                return $query->where('AdminID', session('auth.AdminID'));
            })
            ->get();
        $ReceiveAdminID = DB::table('Admins')
            ->when(session('auth.AdminRoleID') > 2, function ($query, $role) {
                return $query->where('AdminRoleID', 2);
            })->get();

        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->AdminID,
            $request->ReceiveAdminID,
            $request->StartDate,
            $request->EndDate,
            $request->ReadYn
        ];

        $data = DB::select('uspGetStandingLetterSendList ?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingLetterSendListCnt ?,?,?,?,?', $parameter);
        $LetterList = setPaginator($paginate, $page, $data, $count);
        // dd($LetterList);
        return view('latter.sent', [
            'AdminList' => $AdminList,
            'ReceiveAdminID' => $ReceiveAdminID,
            'LetterList' => $LetterList
        ]);
    }
    
    public function post_form_sent(Request $request)
    {
        $request->validate([
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

        $res = DB::select('uspSetStandingLetterInsert ?,?,?,?', [
            $request->AdminID,
            $request->Title,
            $request->Contents,
            $request->ReceiveAdminID
        ]);

        $ID = $res[0]->computed;
        if ($request->Files !== null) {
            foreach($files as $file)
            {
                Storage::move($file['path'], 'inbox/'.$ID.'/'.$file['name']);
                DB::select('uspSetStandingLetterFileInsert ?,?', [
                    $ID,
                    $file['name']
                ]);
            }
        }
    }

    public function view_form_sent()
    {
        $ReceiveAdminID = DB::table('Admins')
            ->when(session('auth.AdminRoleID') > 2, function ($query, $role) {
                return $query->where('AdminRoleID', 2);
            })
            ->when(session('auth.AdminRoleID') < 3, function ($query, $role) {
                return $query->where('AdminRoleID', '>', 2);
            })
            ->get();
        return view('latter.form_sent', [
            'ReceiveAdminID' => $ReceiveAdminID
        ]);
    }

    public function view_pushes()
    {
        return view('latter.pushes');
    }

    public function file_download($id, $fid)
    {
        $FilePath = DB::table('LetterFiles')
            ->where('LetterFileID', $fid)
            ->value('FilePath');

        return Storage::download('inbox/'.$id.'/'.$FilePath);
    }
}
