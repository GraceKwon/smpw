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
