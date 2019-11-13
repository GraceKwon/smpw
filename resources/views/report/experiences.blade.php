@extends('layouts.frames.master')
@section('content')

@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">작성일자</label>
        <date-picker 
            v-model="CreateDate" 
            :input-id="'CreateDate'"
            :input-name="'CreateDate'"
            :input-class="'form-control'"
            :value-type="'format'"
            :icon-day="yyyy"
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
                'label' => '보조자이름',
                'id' =>'AdminName'
            ],
            [
                'label' => '전도인이름',
                'id' =>'PublisherName'
            ]
    ],
    'selectBoxs' => [
            [ 
                'label' => '확인여부',
                'id' => 'BranchConfirmYn',
                'options' => [
                    [
                        'label' => '열람',
                        'value' => 1,
                    ],
                    [
                        'label' => '미열람',
                        'value' => 0,
                    ]
                ] 
            ],
    ]

])

{{-- {{ dd($ExperienceList) }} --}}
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
                        <span>전도인이름</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>성별</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>순회구</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>회중명</span>
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
                        <span>확인여부</span>
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
                    김사랑
                </td>
                <td>
                    형제
                </td>
                <td>
                    경기18
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    <div class="state-no-check">
                        미열람
                    </div>
                </td>
            </tr> --}}
            </tbody>
        </table>
    </div>
    @include('layouts.sections.registrationButton', [
            'label' => '경험담 보고',
        ])
    {{ $ExperienceList->appends( request()->all() )->links() }}

</section>
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
        },
    })

</script>
@endsection