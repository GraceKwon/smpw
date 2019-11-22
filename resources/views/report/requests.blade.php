@extends('layouts.frames.master')
@section('content')
@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">요청일자</label>
        <date-picker 
            v-model="CreateDate" 
            :input-id="'CreateDate'"
            :input-name="'CreateDate'"
            :input-class="'form-control'"
            :value-type="'format'"
            :icon-day="31"
            {{-- :clearable="false" --}}
            :lang="lang" 
            :range="true"
            width="260"
            >
        </date-picker>
</div> <!-- /.search-form-item -->
@endpush
@include('layouts.sections.search', [
    'inputTexts' => [
            [
                'label' => '전도인이름',
                'id' =>'PublisherName'
            ],
            [
                'label' => '관심자이름',
                'id' =>'InsteresterName'
            ]
        ]
])
{{-- {{ dd($VisitRequestList) }} --}}
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
                        <span>성별</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>관심자이름</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>성별</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>거주지역</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>작성일자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>보조자확인</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>처리일자</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($VisitRequestList as $VisitRequest)
            <tr class="pointer"
                onclick="location.href = '/{{request()->path()}}/{{ $VisitRequest->VisitRequestID }}'">
                <td>
                    {{ $VisitRequest->VisitRequestID }}
                </td>
                <td>
                    {{ $VisitRequest->MetroName }}
                </td>
                <td>
                    {{ $VisitRequest->CircuitName }}
                </td>
                <td>
                    {{ $VisitRequest->CongregationName }}
                </td>
                <td>
                    {{ $VisitRequest->PublisherName }}
                </td>
                <td>
                    {{ $VisitRequest->PublisherGender }}
                </td>
                <td>
                    {{ $VisitRequest->PublisherMobile }}
                </td>
                <td>
                    {{ $VisitRequest->InsteresterName }}
                </td>
                <td>
                    {{ $VisitRequest->InsteresterGender }}
                </td>
                <td>
                    {{ $VisitRequest->Sidosigungu }}
                </td>
                <td>
                    {{ $VisitRequest->Mobile }}
                </td>
                <td>
                    {{ $VisitRequest->CreateDate }}
                </td>
                <td>
                    <div class="state-no-check">{{ $VisitRequest->AdminConfirm }}</div>
                </td>
                <td>
                    <div class="state-no-check">{{ $VisitRequest->ReceiptDate }}</div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $VisitRequestList->appends( request()->all() )->links() }}
</section>
@endsection

@section('popup')
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            CreateDate: [
                    '{{ request()->StartDate }}', 
                    '{{ request()->EndDate }}', 
                ],
        }
    })

</script>
@endsection
