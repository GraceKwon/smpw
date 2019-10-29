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
                    <div class="min-width">
                        @if(isset($ServiceTime))
                            <span>봉사타임</span>
                        @else
                            <span v-html="dateToString + '봉사일정이 없습니다.'"></span>
                        @endif
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
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($CancelTypeList as $CancelType)
                            <a class="dropdown-row" href="{{$CancelType->ID}}">{{$CancelType->Item}}</a></a>
                            @endforeach
                        </div>
                        <button class="btn btn-outline-danger btn-block btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm">
                            지원요청하기
                        </button>
                        {{-- <button class="btn btn-outline-danger btn-block btn-sm">
                            구역봉사취소
                        </button> --}}
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
{{-- @section('popup')
<section class="modal-layer-container">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        임의 배정
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="search-section">
                    <div class="search-form-item">
                        <label class="label" for="PublisherName">이름</label>
                        <input type="text" class="form-control" id="PublisherName" name="PublisherName" value="" placeholder="입력해 주세요">
                    </div> <!-- /.search-form-item -->
                    <div class="search-btn-area">
                        <button type="submit" class="btn btn-primary">조회</button>
                    </div> <!-- /.search-btn-area -->
                </div>
                <div class="mlp-content text-center">
                    <div class="table-area">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>도시</th>
                                <th>순회구</th>
                                <th>담당자</th>
                                <th>회중</th>
                                <th>연락처</th>
                                <th>신청일자</th>
                                <th>송장번호 입력</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>남양주</td>
                                <td>경기18</td>
                                <td>홍길동</td>
                                <td>남양주양지</td>
                                <td>010-1423-3232</td>
                                <td>2019-04-30</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm max-w-250px">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">확인</button>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </div>
</section>
@endsection --}}
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
                },
                dateToString:function(){
                    var yyyy = this.today.getFullYear();
                    var mm = ('0' + (this.today.getMonth() + 1)).slice(-2);
                    var dd = ('0' + this.today.getDate()).slice(-2);
                    return yyyy + '년 ' + mm + '월 ' + dd + '일 ';
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
                },
            }
        })
    
    </script>
@endsection
