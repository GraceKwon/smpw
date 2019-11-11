@extends('layouts.frames.master')
@section('content')

    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => '이름',
                'id' =>'AdminName'
            ]
        ]
    ])

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
                    @foreach ($AdminList as $Admin)
                    <tr class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $Admin->AdminID }}'">
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
        @include('layouts.sections.registrationButton', [
            'label' => '사용자 등록',
        ])

        {{ $AdminList->appends( request()->all() )->links() }}
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
