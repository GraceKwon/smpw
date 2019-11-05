@extends('layouts.frames.master')
@section('content')
@include('layouts.sections.search')
{{-- {{ dd(request('CircuitID')) }} --}}
<section class="calender-section justify-content-center">
    <!-- start : common elements wrap -->
    <div class="select-date-wrap no-btn-select">
        <div class="day-area">
            <button class="arrow" @click="_prevCalendar">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year" v-html="year"></div>
            <div class="month" v-html="month"></div>
            {{-- <div class="day">31</div> --}}
            {{-- <div class="weekday">월요일</div> --}}
            <button class="arrow" @click="_nextCalendar">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>
        <div class="btn-area">
            <button class="btn btn-outline-secondary btn-today btn-sm"
            @click="_today">
                오늘
            </button>
            {{-- <button class="btn btn-outline-secondary btn-today btn-sm">
            <i class="far fa-calendar-check"></i>
            </button> --}}
            {{-- <button class="btn btn-outline-secondary btn-select btn-sm">
            <i class="far fa-calendar-alt"></i>
            </button> --}}
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
                        <span>일</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>월</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>화</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>수</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>목</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>금</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>토</span>
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
                            onclick="location.href='{{ request()->path() }}/{{ session('auth.CircuitID') ?? request()->CircuitID }}?ServiceDate={{ $SetMonth . '-' . sprintf ('%02d', $day ) }}'"
                        @else
                            onclick="alert('지역을 선택해주세요')"
                        @endif>
                        <div class="day 
                            @if( $i % 7 === 0 ) sun @endif
                            @if( ($i+1) % 7 === 0 ) sat @endif">
                            {{$day}}
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                        <i class="fas fa-map-marked-alt"></i>
                        <div class="cal-value">{{ $dailyServicePlanCnt[$day]->ServiceZoneCnt ?? 0}}</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">{{$dailyServicePlanCnt[$day]->PublisherCnt ?? 0}}</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">{{$dailyServicePlanCnt[$day]->LeaderCnt ?? 0}}</div>
                        </div>
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
            today: new Date("{{ $SetMonth ?? '' }}"),
        },
        watch: {
            today: function(){
                location.href = '?SetMonth=' + this.yyyymm;
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
                this.today = new Date();
            }
        }
    })

</script>
@endsection
