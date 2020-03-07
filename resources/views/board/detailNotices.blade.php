@extends('layouts.frames.master')
@section('content')

<section class="register-section">
    <table class="table table-notice-view">
        <thead>
        <tr>
            <td>
                <div>
                    <span class="text-muted font-size-80 mr-2">[{{ $Notice->MetroName }} / {{ $Notice->CircuitName }} / {{ $Notice->ReceiveGroup }}]</span>
                    <span class="notice-title">{{ $Notice->Title }}</span>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <small class="text-muted">Hits : {{ $Notice->ReadCnt }}</small>
                    <small class="text-muted ml-3">Date : {{ $Notice->CreateDate }}</small>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>
        @if ( count($Files) )
        <tr>
            <td>
                <div class="d-flex">
                    <label class="label">첨부파일</label>
                    <div>
                        @foreach ($Files as $File)
                            <a class="file" href="/notices/{{ request('id') }}/file/{{ $File->NoticeFileID }}">{{ $File->FilePath }}</a>
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
        @endif
        <tr>
            <td>
                <div>
                    {!! $Notice->Contents !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="table table-register mt-3">
        <tbody>
        <tr>
            <th>
                <label class="label">이전글</label>
            </th>
            <td>
                <a href="#">{{ $noticePre[0]->NoticeID ?? '' }}</a>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">다음글</label>
            </th>
            <td>
                <a href="#">{{ $noticeNext[0]->NoticeID ?? '' }}</a>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        @if ($modify)
        <button type="button" 
                class="btn btn-secondary" 
                onclick="location.href='/notices/{{ $Notice->NoticeID }}/form'">수정</button>
        @endif
        <button type="button" 
            class="btn btn-outline-secondary" 
            onclick="location.href='{{ url()->previous() }}'">목록</button>
      
    </div> <!-- /.register-btn-area -->
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
