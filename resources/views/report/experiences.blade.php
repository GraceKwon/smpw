@extends('layouts.frames.master')
@section('content')

@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">{{ __('msg.DP') }}</label>
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
                'label' => __('msg.ANAME'),
                'id' =>'AdminName'
            ],
            [
                'label' => __('msg.PLISH_NAME'),
                'id' =>'PublisherName'
            ]
    ],
    'selectBoxs' => [
            [
                'label' => __('msg.REV'),
                'id' => 'BranchConfirmYn',
                'options' => [
                    [
                        'label' => __('msg.YES'),
                        'value' => '1',
                    ],
                    [
                        'label' => __('msg.NO'),
                        'value' => '0',
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
                        <span>{{ __('msg.CITY') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.A') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.ANAME') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.PLISH_NAME') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.GENDER') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CGN') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TEL') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.DATE_OF_PRE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.REV') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($ExperienceList as $Experience)
                <tr class="pointer"
                    onclick="location.href='{{ request()->path() }}/{{ $Experience->ExperienceID }}'">
                    <td>
                        {{ $Experience->ExperienceID }}
                    </td>
                    <td>
                        {{ $Experience->MetroName }}
                    </td>
                    <td>
                        {{ $Experience->CircuitName }}
                    </td>
                    <td>
                        {{ $Experience->AdminName }}
                    </td>
                    <td>
                        {{ $Experience->PublisherName }}
                    </td>
                    <td>
                        {{ $Experience->PublisherGender }}
                    </td>
                    <td>
                        {{ $Experience->CongregationName }}
                    </td>
                    <td>
                        {{ $Experience->Mobile }}
                    </td>
                    <td>
                        {{ $Experience->CreateDate }}
                    </td>
                    <td>
                        <div class="state-no-check">
                        {{ $Experience->BranchConfirmYn }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(session('auth.CircuitID'))
        @include('layouts.sections.registrationButton', [
                'label' => __('msg.RO'),
            ])
    @endif
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
