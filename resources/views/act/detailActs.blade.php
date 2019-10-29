@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-between">
    <div>
        <button class="btn btn-primary btn-sm">요일봉사취소</button>
    </div>
    <!-- start : common elements wrap -->
    <div class="select-date-wrap">
        <div class="day-area">
            {{-- <button class="arrow" @click="_prevDate">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year">@{{ year }}</div>
            <div class="month">@{{ month }}</div>
            <div class="day">@{{ day }}</div> --}}
            {{-- <div class="weekday">@{{ weekday }}</div> --}}
            {{-- <button class="arrow" @click="_nextDate">
                <i class="fas fa-angle-right"></i>
            </button> --}}
        </div>
        <div class="btn-area">
            {{-- <button class="btn btn-outline-secondary btn-today btn-sm">
                <i class="far fa-calendar-check"></i>
            </button> --}}
            <button class="arrow" @click="_prevDate">
                <i class="fas fa-angle-left"></i>
            </button>
            {{-- <input type="date" class="form-control" :value="yyyymmdd" @change="_changeDate" placeholder="날자를 선택해 주세요"> --}}
            <date-picker v-model="today" 
                        width="180"
                        value-type="date" 
                        :clearable="false"
                        input-class="form-control"
                        :format="'YYYY. MM. DD ' + weekday"
                        :lang="lang" 
                        :icon-day="day"
                        {{-- :range="true" --}}
                        >
            </date-picker>
            <button class="btn btn-outline-secondary btn-today btn-sm"
                @click="_today">
                오늘
            </button>
            <button class="arrow" @click="_nextDate">
                <i class="fas fa-angle-right"></i>
            </button>
            {{-- <button class="btn btn-outline-secondary btn-select btn-sm">
                <i class="far fa-calendar-alt"></i>
            </button> --}}
        </div>
    </div>
    <!-- end : common elements wrap -->
    <div>
        <button class="btn btn-primary btn-sm">지원요청하기</button>
    </div>
</section>

<section class="section-table-section schedule-detail">
    <div class="table-responsive">
        <table class="table table-bordered table-striped-even table-font-size-90">
            <thead>
            <tr>
                <th class="text-center">
                    <div class="min-width sun">
                        <span>봉사타임</span>
                    </div>
                </th>
                @if(isset($ServiceTime))
                    @for ($time = $ServiceTime['min'] ; $time <= $ServiceTime['max'] ; $time ++)
                    <th class="text-center">
                        <div class="min-width">
                            <span>{{ sprintfServiceTime($time) }}</span>
                        </div>
                    </th>
                    @endfor
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($DailyServicePlanList as $ZoneName => $ServicePlanList)
            <tr>
                <td>
                    <div class="territory-name">
                        {{ $ZoneName }}
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-danger btn-block btn-sm">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm">
                            지원요청하기
                        </button>
                    </div>
                </td>
                @for ($time = $ServiceTime['min'] ; $time <= $ServiceTime['max'] ; $time ++)
                <td>
                    <div class="publisher-area">
                        <ul>
                        @if(isset($ServicePlanList[$time]))
                            @foreach($ServicePlanList[$time] as $Publisher)
                            <li>
                                <div class="name @if($Publisher['LeaderYn']) introducer @endif">{{  $Publisher['PublisherName'] }}</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-secondary btn-block btn-sm">
                            임의배정
                        </button>
                        <button class="btn btn-outline-danger btn-block btn-sm">
                            봉사취소
                        </button>
                    </div>
                </td>
                @endfor
            </tr>
            @endforeach
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
                today: new Date('{{ request()->ServiceDate }}'),
                week: ['일', '월', '화', '수', '목', '금', '토'],
                lang: {
                    days: ['일', '월', '화', '수', '목', '금', '토'],
                    months: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                    pickers: ['다음 7일', '다음 30일', '이전 7일', '이전 30일'],
                    placeholder: {
                        date: '날짜를 선택해주세요',
                        dateRange: '기간을 선택해주세요'
                    }
                },
            },
            watch: {
                today: function(){
                    location.href = this.yyyymmdd;
                    // history.pushState(null, null, this.yyyymmdd);
                },
            },
            computed:{
                year: function(){
                    return this.today.getFullYear();
                },
                month: function(){
                    return this.today.getMonth() + 1;  
                },
                day: function(){
                    return this.today.getDate();  
                },
                weekday: function(){
                    return this.week[this.today.getDay()];  
                },
                yyyymmdd:function(){
                    var yyyy = this.today.getFullYear();
                    var mm = ('0' + (this.today.getMonth() + 1)).slice(-2);
                    var dd = ('0' + this.today.getDate()).slice(-2);
                    return yyyy + '-' + mm + '-' + dd;
                }
            },
            methods:{
                _prevDate:function () {
                    this.today = new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate() - 1);
                },
                _nextDate:function () {
                    this.today = new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate() + 1);
                },
                _today:function () {
                    this.today = new Date();
                },
                _changeDate:function (e) {
                    if(e.target.value) this.today = new Date(e.target.value);
                }
            }
        })
    
    </script>
@endsection
