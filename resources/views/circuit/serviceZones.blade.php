@extends('layouts.frames.master')
@section('content')
    @include('layouts.sections.searchCalendar')

    <section class="section-table-section edit-circuits-territory-list">
        <div class="table-responsive">
            <table class="table table-center table-hover table-font-size-90">
                <thead>
                <tr>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.PRI') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.AREA_NAME') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.AREA_CODE') }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.REGT') }}</span>
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
                    @foreach($ServiceZones as $ServiceZone)
                    <tr class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ServiceZone->ServiceZoneID }}'">
                        <td>
                            {{ $ServiceZone->OrderNum }}
                        </td>
                        <td>
                            {{ $ServiceZone->ZoneName }}
                        </td>
                        <td>
                            {{ $ServiceZone->ZoneAlias }}
                        </td>
                        <td>
                            {{ $ServiceZone->AdminName }}
                        </td>
                        <td>
                            {{ $ServiceZone->CreateDate }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('auth.CircuitID'))
            @include('layouts.sections.registrationButton', [
                'label' => __('msg.AREA_REG'),
            ])
        @endif
        {{-- {{ $ServiceZoneList->links() }} --}}


    </section>
@endsection
