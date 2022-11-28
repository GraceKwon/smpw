@extends('layouts.frames.master')
@section('content')
    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => __('msg.NAME'),
                'id' =>'PublisherName'
            ]
        ],
        'selectBoxs' => [
            [
                'label' => __('msg.GENDER'),
                'id' => 'Gender',
                'options' => [
                    [
                        'label' => __('msg.BRO'),
                        'value' => 'M',
                    ],
                    [
                        'label' => __('msg.SIS'),
                        'value' => 'F',
                    ]
                ]
            ],
            [
                'label' => __('msg.STATUS'),
                'id' => 'UseYn',
                'options' => [
                    [
                        'label' => __('msg.IS'),
                        'value' => '1',
                    ],
                    [
                        'label' => __('msg.SS'),
                        'value' => '0',
                    ]
                ]
            ],
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
                        <span>{{ __('msg.PS') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.STATUS') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TEL') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CREATE_AT') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($PublisherList as $Publisher)
                <tr class="pointer"
                    onclick="location.href = '/{{request()->path()}}/{{ $Publisher->PublisherID }}'">
                    <td>
                        {{ $Publisher->PublisherID }}
                    </td>
                    <td>
                        {{ $Publisher->MetroName }}
                    </td>
                    <td>
                        {{ $Publisher->CircuitName }}
                    </td>
                    <td>
                        {{ $Publisher->CongregationName }}
                    </td>
                    <td>
                        {{ $Publisher->PublisherName }}
                    </td>
                    <td>
                        @if($Publisher->Gender === 'M') {{ __('msg.BRO') }}
                        @elseif($Publisher->Gender === 'F') {{ __('msg.SIS') }} @endif
                    </td>
                    <td>
                        {{ $Publisher->ServantType }}
                    </td>
                    <td>
                        {{ $Publisher->EndKind }}
                    </td>
                    <td>
                        {{ $Publisher->Mobile }}
                    </td>
                    <td>
                        {{ $Publisher->CreateDate }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(session('auth.MetroID') === 1)
        @if(session('auth.AdminRoleID') === 5)
            @include('layouts.sections.registrationButton', [
                'label' => __('msg.REP'),
            ])
        @endif
    @elseif(empty(session('auth.CircuitID')))
        @include('layouts.sections.registrationButton', [
                'label' => __('msg.REP'),
            ])
    @else
        @if(session('auth.CircuitID'))
            @include('layouts.sections.registrationButton', [
                'label' => __('msg.REP'),
            ])
        @endif
    @endif
    {{ $PublisherList->appends( request()->all() )->links() }}

</section>
@endsection
