@extends('layouts.frames.master')
@section('content')

    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => __('msg.NAME'),
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
                            <span>{{ __('msg.CITY') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.AREA') }}</span>
                        </div>
                    </th>
                    {{-- <th>
                        <div class="min-width">
                            <span>회중</span>
                        </div>
                    </th> --}}
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.NAME') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.TEL') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.PER') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.SD') }}</span>
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
                            {{ $Admin->CircuitName }}
                        </td>
                        {{-- <td>
                            {{ $Admin->CongregationName }}
                        </td> --}}
                        <td>
                            {{ $Admin->AdminName }}
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
            'label' => __('msg.UR'),
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
