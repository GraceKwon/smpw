@extends('layouts.frames.master')
@section('content')
@if( !session('auth.CircuitID') && !request()->CircuitID )
    <div class="alert alert-danger">{{ __('msg.NO_DIST') }}</div>
@endif
@include('layouts.sections.searchCalendar')
<section class="calender-section justify-content-center">
    <!-- start : common elements wrap -->
    <div class="select-date-wrap no-btn-select">
        <div class="day-area">
            <button class="arrow" @click="_prevCalendar">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year" v-html="year"></div>
            <div class="month" v-html="month"></div>
            <button class="arrow" @click="_nextCalendar">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>
        <div class="btn-area">
            <button class="btn btn-outline-secondary btn-today btn-sm"
            @click="_today">
                {{ __('msg.TODAY') }}
            </button>
        </div>
    </div>
    <!-- end : common elements wrap -->
</section>

<section class="section-table-section schedule-overview">
    <div class="table-responsive">
        <table class="table table-bordered table-font-size-90" ref="calendar">
            <thead>
            <tr>
                <th class="text-center">
                    <div class="min-width sun">
                        <span>{{ __('msg.SU') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>{{ __('msg.MO') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>{{ __('msg.TU') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>{{ __('msg.WE') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>{{ __('msg.TH') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>{{ __('msg.FR') }}</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>{{ __('msg.SA') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $firstWeek; $i++)
                    @if( $i%7 === 0 ) <tr> @endif
                    <td></td>
                @endfor
                @for ($day = 1 ; $day <= $lastDay ; $day ++)
                    @if( $i % 7 === 0 ) <tr> @endif
                    <td @if(session('auth.CircuitID') || request()->CircuitID)
                            onclick="location.href='{{ request()->path() }}/{{ session('auth.CircuitID') ?? request()->CircuitID }}?ServiceDate={{ request()->SetMonth . '-' . sprintf ('%02d', $day ) }}'"
                        @endif
                        @if( $day === (int)date('d'))
                            class="isToday"
                        @endif
                        >
                        <div class="day
                            @if( $i % 7 === 0 ) sun @endif
                            @if( ($i+1) % 7 === 0 ) sat @endif">
                            {{$day}}
                        </div>
                        @if(session('auth.CircuitID') || request()->CircuitID)
                            <div class="cal-item">
                                <div class="cal-label">{{ __('msg.NT') }}</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">{{ $dailyServicePlanCnt[$day]->ServiceZoneCnt ?? 0}}</div>
                            </div>
                            <div class="cal-item">
                                <div class="cal-label">{{ __('msg.NP') }}</div>
                                <i class="fas fa-user-friends"></i>
                                <div class="cal-value">{{$dailyServicePlanCnt[$day]->PublisherCnt ?? 0}}</div>
                            </div>
                            <div class="cal-item">
                                <div class="cal-label">{{ __('msg.CON') }}</div>
                                <i class="fas fa-user-tie"></i>
                                <div class="cal-value">{{$dailyServicePlanCnt[$day]->LeaderCnt ?? 0}}</div>
                            </div>
                        @endif
                    </td>
                    @php($i++)
                    @if( $i%7 === 0 ) </tr> @endif
                @endfor
            </tbody>
        </table>
    </div>
</section>
@endsection
@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            today: new Date("{{ request()->SetMonth }}"),
        },
        watch: {
            today: function(){
                location.href = '?MetroID={{ request()->MetroID }}&CircuitID={{ request()->CircuitID }}&SetMonth=' + this.yyyymm;
            }
        },
        computed:{
            year: function(){
                return this.today.getFullYear();
            },
            month: function(){
                return this.today.getMonth() + 1;
            },
            yyyymm:function(){
                var yyyy = this.today.getFullYear();
                var mm = ('0' + (this.today.getMonth() + 1)).slice(-2);
                return yyyy + '-' + mm;
            }
        },
        methods:{
            _prevCalendar:function () {
                this.today = new Date(this.today.getFullYear(), this.today.getMonth() - 1, this.today.getDate());
            },
            _nextCalendar:function () {
                this.today = new Date(this.today.getFullYear(), this.today.getMonth() + 1, this.today.getDate());
            },
            _today:function () {
                var yyyy = new Date().getFullYear();
                var mm = ('0' + (new Date().getMonth() + 1)).slice(-2);
                var dd = ('0' + (new Date().getDate())).slice(-2);
                var yyyymmdd = yyyy + '-' + mm + '-' + dd;
                location.href='{{ request()->path() }}/{{ session('auth.CircuitID') ?? request()->CircuitID }}?ServiceDate=' + yyyymmdd;
            }
        }
    })

</script>
@endsection
