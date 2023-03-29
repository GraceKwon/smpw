@extends('layouts.frames.master')
@section('content')
@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">{{ __('msg.RDD') }}</label>
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
                'label' => __('msg.PLISH_NAME'),
                'id' =>'PublisherName'
            ],
            [
                'label' => __('msg.INTEREST_ONE_NAME'),
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
                        <span>{{ __('msg.CITY') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.AREA') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CGN') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.NAME') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.GENDER') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TEL') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.INTEREST_ONE_NAME') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.GENDER') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.RD') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TEL') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.DP') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.AC') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.PDATA') }}</span>
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
