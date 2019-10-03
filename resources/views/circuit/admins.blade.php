@extends('layouts.frames.master')
@section('content')
<form method="GET">
    <section class="search-section">

        @include('layouts.sections.selectbox', [
            'inputText' => [
                'label' => '이름',
                'id' =>'AdminName'
            ],
            'inputDate' => [
                'label' => '날짜',
                'id' =>'Date'
            ],
        ])

    <div class="search-btn-area">
        <button type="submit" class="btn btn-primary">조회</button>
    </div> <!-- /.search-btn-area -->
    </section>
</form>

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
                        <span>순회구</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>회중</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>이름</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>신분</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>권한</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지정일자</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>
                        201
                    </td>
                    <td>
                        남양주
                    </td>
                    <td>
                        경기18
                    </td>
                    <td>
                        남양주양지
                    </td>
                    <td>
                        김사랑
                    </td>
                    <td>
                        장로
                    </td>
                    <td>
                        010-1234-5678
                    </td>
                    <td>
                        보조자
                    </td>
                    <td>
                        2019-03-23
                    </td>
                </tr> --}}
                @foreach ($AdminList as $Admin)
                <tr>
                    <td>
                        {{ $Admin->AdminID }}
                    </td>
                    <td>
                        {{ $Admin->MetroName }}
                    </td>
                    <td>
                        순회구
                    </td>
                    <td>
                        회중
                    </td>
                    <td>
                        {{ $Admin->AdminName }}
                    </td>
                    <td>
                        신분
                    </td>
                    <td>
                        {{ $Admin->Mobile }}
                    </td>
                    <td>
                        {{ $Admin->AdminRole }}
                    </td>
                    <td>
                        {{ $Admin->CreateDate }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary" onclick="location.href = '/{{request()->path()}}/0'">사용자 등록</button>
    </div>
    {{ $AdminList->appends( request()->all() )->links() }}
    {{-- @include('layouts.sections.pagination', [
        'limit' => 10,
        'totalRows' => 3,
        'lastPage' => 1,
        'currentPage' => 3,
        ]) --}}

    {{-- <div>
        <ul class="page">
            <li class="active"><a>1</a></li>
            <li><a>2</a></li>
            <li><a>3</a></li>
            <li><a>4</a></li>
            <li><a>5</a></li>
        </ul>
    </div> --}}
</section>
@endsection

@section('popup')
    <!-- <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-800px">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            <span>Modal layer popup</span>
                        </div>
                        <div class="mlp-close">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content">
                        점검중입니다
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-secondary btn-sm">취소</button>
                        <button class="btn btn-primary btn-sm">확인</button>
                    </div>
                </div>
            </div> 
        </div>
    </section> -->
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
