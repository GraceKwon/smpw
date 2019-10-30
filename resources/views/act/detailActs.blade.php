@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-between">
    <div>
        <button class="btn btn-danger btn-sm"
            @click="_showPopup('popupCancel')">요일봉사취소</button>
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
        <button class="btn btn-primary btn-sm" @click="_showPopup('popupPublisherSet')">지원요청하기</button>
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
                        <button class="btn btn-outline-danger btn-block btn-sm" @click="_showPopup('popupCancel')">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm" @click="_showPopup('popupPublisherSet')">
                            지원요청하기
                        </button>
                    </div>
                </td>
                @for($time = $ServiceTime['min'] ; $time <= $ServiceTime['max'] ; $time ++)
                <td>
                    <div class="publisher-area">
                        @if(isset($ServicePlanList[$time]))
                        <ul>
                            @foreach($ServicePlanList[$time] as $Publisher)
                            <li>
                                <div class="name @if($Publisher->LeaderYn) introducer @endif">
                                    {{  $Publisher->PublisherName }}
                                </div>
                                <div class="del" @click="_showPopup('popupCancelPublisher')">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-secondary btn-block btn-sm" 
                            @click="_showPopup('popupPublisherSet');
                                _setParams('popupPublisherSet',{
                                    ServiceTime: '{{$time}}',
                                    ServiceZoneID: '{{$ServicePlanList["ServiceZoneID"]}}',
                                })">
                            임의배정
                        </button>
                        <button class="btn btn-outline-danger btn-block btn-sm" 
                            @click="_showPopup('popupCancel')">
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
@section('popup')
    @include('layouts.sections.popupCancel')
    @include('layouts.sections.popupCancelPublisher')
    @include('layouts.sections.popupPush')
    @include('layouts.sections.popupPublisherSet')
@endsection
@section('script')
<script>
        var app = new Vue({
            el:'#wrapper-body',
            data:{
                DEFAULT_VALUES:{
                    ServiceZoneID: null,
                    ServiceTime: null,
                    PublisherID: null,
                    LeaderYn: '0',
                },
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
                popupPublisherSet: {
                    ServiceZoneID: null,
                    ServiceTime: null,
                    PublisherID: null,
                    LeaderYn: '0',
                }
            
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
                _showPopup:function (popupName) {
                    // this[popup] =true;
                    this.$refs[popupName].style.display = 'flex';
                },
                _closePopup:function (popupName) {
                    // this[popup] =false;
                    this.$refs[popupName].style.display = 'none';
                    this._retsetParams(popupName)
                },
                _submit:function (popupName) {
                    var formData = {
                        ServiceDate: this.yyyymmdd,
                    }
                    Object.assign(formData, this[popupName]);
                    axios.put('/api/' + popupName, formData)
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                _setParams:function (popupName,params){
                    Object.assign(this[popupName], params);
                    // this.params[popupName] = params
                },
                _retsetParams:function (popupName){
           
                    for (var key in this.DEFAULT_VALUES) {
                        if (this[popupName].hasOwnProperty(key)) {
                            console.log(key,this[popupName][key]);
                             this[popupName][key] = this.DEFAULT_VALUES[key];
                            console.log(key,this[popupName][key]);

                        }
                    }
                    // this.params[popupName] = params
                },
            }
        })
    
    </script>
@endsection
