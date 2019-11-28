@extends('layouts.frames.master')
@section('content')
<!-- +"AdminID": 2
    +"AdminName": "개발자"
    +"ReceiveAdminID": 1
    +"ReceiveAdminName": "김승균"
    +"Title": "메시지함 보내기"
    +"Contents": "메시지 입력"
    +"ReceiveDate": null
    +"ReadYn": 0
    +"CreateDate": "2019-11-25" -->
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">보낸사람</label>
            </th>
            <td>
                <div>{{ $letter->AdminName }}</div>
            </td>
            <th>
                <label class="label">받는사람</label>
            </th>
            <td>
                <div>{{ $letter->ReceiveAdminName }}</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <div class="text-primary font-weight-bold">{{ $letter->Title }}</div>
            </td>
        </tr>
        
        @if ( count($Files) )
        <tr>
            <th>
                <label class="label">첨부파일</label>
            </th>
            <td colspan="3">
                @foreach ($Files as $File)
                    <a class="file" href="/letter/{{ request('id') }}/file/{{ $File->LetterFileID }}">{{ $File->FilePath }}</a>
                @endforeach
            </td>
        </tr>
        @endif
        <tr>
            <th>
                <label class="label">메시지</label>
            </th>
            <td colspan="3">
                <div>
                    {!! $letter->Contents !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end mt-3">
            <button 
                type="button" 
                class="btn btn-secondary"
                onclick="location.href='{{ url()->previous() }}'">취소</button>
            <button type="button" class="btn btn-primary">메시지보내기</button>
    </div>
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
