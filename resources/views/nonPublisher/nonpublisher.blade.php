@extends('layouts.frames.master')
@section('content')
    @include('layouts.sections.searchNonPublihser', [
    'selectBoxs' => [
            [
                'label' => '미참여기간',
                'id' => 'Month',
                'options' => [
                    [
                        'label' => '1 개월',
                        'value' => '1',
                    ],
                    [
                        'label' => '2 개월',
                        'value' => '2',
                    ],
                    [
                        'label' => '3 개월',
                        'value' => '3',
                    ],
                    [
                        'label' => '4 개월',
                        'value' => '4',
                    ],
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
                            <span>ID</span>
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
                            <span>최종봉사일자</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($PublisherList as $i => $Publisher)
                    <tr>
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
                            {{ $Publisher->Gender }}
                        </td>
                        <td>
                            {{ $Publisher->ServantTypeID }}
                        </td>
                        <td>
                            {{ $Publisher->UseYn }}
                        </td>
                        <td>
                            {{ $Publisher->Mobile }}
                        </td>
                        <td>
                            {{ $Publisher->LastServiceDate }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="btn-flex-area mt-3">
            <button type="button" class="btn btn-success"
                    @click="_export">
                미참여 봉사자 리스트 엑셀 다운로드
            </button>
        </div>

        {{ $PublisherList->appends( request()->all() )->links() }}

    </section>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el:'#wrapper-body',
            data:{},
            computed:{
                query: function () {
                    var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->CircuitID }}';
                    query += '&Month={{ request()->Month }}';
                    return query;
                }
            },
            methods:{
                _export:function () {
                    location.href = '/{{ request()->path() }}/export' + this.query;
                }
            }
        })
    </script>
@endsection
