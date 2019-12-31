@extends('layouts.frames.master')
@section('content')
    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => '이름',
                'id' =>'PublisherName'
            ]
        ],
        'selectBoxs' => [
            [ 
                'label' => '성별',
                'id' => 'Gender',
                'options' => [
                    [
                        'label' => '형제',
                        'value' => 'M',
                    ],
                    [
                        'label' => '자매',
                        'value' => 'F',
                    ]
                ] 
            ],
            [ 
                'label' => '상태',
                'id' => 'EndYn',
                'options' => [
                    [
                        'label' => '봉사중',
                        'value' => '0',
                    ],
                    [
                        'label' => '중단',
                        'value' => '1',
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
                        <span>신분</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>상태</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>등록일자</span>
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
                        @if($Publisher->Gender === 'M') 형제
                        @elseif($Publisher->Gender === 'F') 자매 @endif
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
    @if(session('auth.CircuitID'))
        @include('layouts.sections.registrationButton', [
            'label' => '봉사자 등록',
        ])
    @endif

    {{ $PublisherList->appends( request()->all() )->links() }}

</section>
@endsection