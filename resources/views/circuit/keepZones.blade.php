@extends('layouts.frames.master')
@section('content')

    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => '이름',
                'id' =>'keepZoneName'
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
                            <span>관리자 이름</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>연락처</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>보관장소 주소</span>
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
                            서울 송파구 문정동 324-942 2층
                        </td>
                        <td>
                            2019-03-23
                        </td>
                    </tr> --}}
                    @foreach ($KeepZoneList as $KeppZone)
                    <tr class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $KeppZone->KeepZoneID }}'">
                        <td>
                            {{ $KeppZone->KeepZoneID }}
                        </td>
                        <td>
                            {{ $KeppZone->MetroName }}
                        </td>
                        <td>
                            {{ $KeppZone->CircuitName }}
                        </td>
                        <td>
                            {{ $KeppZone->CongregationName }}
                        </td>
                        <td>
                            {{ $KeppZone->AdminName }}
                        </td>
                        <td>
                            {{ $KeppZone->Mobile }}
                        </td>
                        <td>
                            {{ $KeppZone->ZoneAddress }}
                        </td>
                        <td>
                            {{ $KeppZone->CreateDate }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('auth.CircuitID'))
            @include('layouts.sections.registrationButton', [
                'label' => '보관장소 등록',
            ])
        @endif


        {{ $KeepZoneList->appends( request()->all() )->links() }}

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
