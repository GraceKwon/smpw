@extends('layouts.frames.master')
@section('content')
@include('layouts.sections.searchNotice')

<section class="section-table-section">
    <div class="table-responsive">
        <table class="table table-center table-font-size-90">
            <thead>
            <tr>
                <th>
                    <div class="min-width">
                        <span>No</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>도시</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지역(순회구)</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>열람대상</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>제목</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>작성자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>조회수</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>작성일자</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
         

            @foreach ($NoticeList as $Notice)
                <tr class="pointer"
                    onclick="location.href = '/{{ request()->path() }}/{{ $Notice->NoticeID }}?page={{ request()->page }}&MetroID={{ request()->MetroID }}&CircuitID={{ request()->CircuitID }}&ReceiveGroupID={{ request()->ReceiveGroupID }}'">
                    <td>
                        {{ $Notice->NoticeID }}
                    </td>
                    <td>
                        {{ $Notice->MetroName }}
                    </td>
                    <td>
                        {{ $Notice->CircuitName }}
                    </td>
                    <td>
                        {{ $Notice->ReceiveGroup }}
                    </td>
                    <td class="title">
                        <div class="d-flex">
                            @if ($Notice->FileYn)
                                <div class="icon-file">
                                    <i class="fas fa-paperclip"></i>
                                </div>
                            @endif
                            <div>
                                <a>{{ $Notice->Title }}</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $Notice->AdminName }}
                    </td>
                    <td>
                        {{ $Notice->ReadCnt }}
                    </td>
                    <td>
                        {{ $Notice->CreateDate }}
                    </td>
                </tr>
            @endforeach
            @if (count($NoticeList) === 0)
                <tr>
                    <td colspan="8">데이터가 없습니다.</td>
                </tr>
            @endif  
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button 
            type="button" 
            class="btn btn-primary" 
            onclick="location.href='/notices/0/form'">
            공지사항 등록
        </button>
    </div>
    {{ $NoticeList->appends( request()->all() )->links() }}
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
