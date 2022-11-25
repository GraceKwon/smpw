@extends('layouts.frames.master')
@section('content')

    @include('layouts.sections.search', [
        'inputTexts' => [
            [
                'label' => __('msg.NAME'),
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
                            <span>{{ __('msg.SN') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.TEL') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.SPA') }}</span>
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
                'label' => __('msg.SPR'),
            ])
        @endif

        {{ $KeepZoneList->appends( request()->all() )->links() }}

    </section>
@endsection
