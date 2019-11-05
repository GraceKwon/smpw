@extends('layouts.frames.master')
@section('content')
@if(!count($dailyServicePlanDetail))
    <div class="alert alert-danger">봉사일정이 없습니다.</div>
@endif
<section class="calender-section justify-content-between">
    <div>
        <button class="btn btn-danger btn-sm"
            @if(count($dailyServicePlanDetail) == 0)
                disabled
            @endif
            @click="_setParams({
                CancelRange: 'today',
            });_showModal('modalCancel')">
            요일봉사취소</button>
    </div>
    <!-- start : common elements wrap -->
    <div class="select-date-wrap">
        <div class="btn-area">
            {{-- <button class="btn btn-outline-secondary btn-today btn-sm">
                <i class="far fa-calendar-check"></i>
            </button> --}}
            <button class="arrow" @click="_prevDate">
                <i class="fas fa-angle-left"></i>
            </button>
            <date-picker v-model="today" 
                        width="180"
                        value-type="date" 
                        :clearable="false"
                        input-class="form-control"
                        :format="'YYYY. MM. DD ' + weekday"
                        :lang="lang" 
                        :icon-day="day"
                        >
            </date-picker>
            <button class="btn btn-outline-secondary btn-today btn-sm"
                @click="_today">
                오늘
            </button>
            <button class="arrow" @click="_nextDate">
                <i class="fas fa-angle-right"></i>
            </button>

        </div>
    </div>
    <!-- end : common elements wrap -->
    <div>
        <button class="btn btn-primary btn-sm" @click="_showModal('')">지원요청하기</button>
    </div>
</section>

<section class="section-table-section schedule-detail">
    <div class="table-responsive">
        <table class="table table-bordered table-striped-even table-font-size-90">
            <thead>
                @if( !empty($ServiceTimeList) )
                <tr>
                    <th class="text-center">
                        <div class="min-width">
                            <span>봉사타임</span>
                        </div>
                    </th>
                    @for ($time = $min ; $time <= $max ; $time ++)
                    <th class="text-center">
                        <div class="min-width">
                            <span>{{ sprintfServiceTime($time) }}</span>
                        </div>
                    </th>
                    @endfor
                </tr>
                @endif
            </thead>
            <tbody>
            @foreach($ServiceTimeList as $ServiceZoneID => $ArrayTimeID)
            <tr>
                <td>
                    <div class="territory-name">
                        {{ $ArrayTimeID['ZoneName'] ?? ''}}
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-danger btn-block btn-sm" 
                            @if(empty($dailyServicePlanDetail[$ServiceZoneID]))
                                disabled
                            @endif
                            @click="_setParams({
                                ServiceZoneID: '{{$ServiceZoneID}}',
                                CancelRange: 'zone',
                            });_showModal('modalCancel')">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm" @click="_showModal('modalPublisherSet')">
                            지원요청하기
                        </button>
                    </div>
                </td>
                @for($time = $min ; $time <= $max ; $time ++)
                <td>
                    <div class="publisher-area">
                    @if(isset($dailyServicePlanDetail[$ServiceZoneID][$time]))
                        <ul>
                            @foreach($dailyServicePlanDetail[$ServiceZoneID][$time] as $Publisher)
                            <li>
                                <div class="name @if($Publisher->LeaderYn) introducer @endif">
                                    {{  $Publisher->PublisherName }}
                                </div>
                                <div class="del" @click="_setParams({
                                        ServiceZoneID: '{{ $ServiceZoneID }}',
                                        ServiceTimeID: '{{ $Publisher->ServiceTimeID }}',
                                        PublisherID: '{{ $Publisher->PublisherID }}',
                                    });
                                    _showModal('modalPublisherCancel')">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-secondary btn-block btn-sm" 
                            alt="d"
                            @click="_setParams({
                                ServiceZoneID: '{{ $ServiceZoneID }}',
                                ServiceTimeID: '{{ $ArrayTimeID[$time] }}',
                            });
                            _showModal('modalPublisherSet');
                            ">
                            임의배정
                        </button>
                        <button class="btn btn-outline-danger btn-block btn-sm" 
                            @if(empty($dailyServicePlanDetail[$ServiceZoneID][$time]))
                                disabled
                            @endif
                            @click="_setParams({
                                ServiceZoneID: '{{ $ServiceZoneID }}',
                                ServiceTimeID: '{{ $ArrayTimeID[$time] }}',
                                CancelRange: 'time',
                            });_showModal('modalCancel')">
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
    <modal-publisher-set v-if="showModal === 'modalPublisherSet'" 
        :circuit-id="CircuitID"
        :service-date="yyyymmdd" 
        :service-time-id="ServiceTimeID" 
        :service-zone-id="ServiceZoneID"
        @close="showModal = ''" >
    </modal-publisher-set>

    <modal-publisher-cancel v-if="showModal === 'modalPublisherCancel'" 
        :service-zone-id="ServiceZoneID"
        :service-time-id="ServiceTimeID" 
        :service-date="yyyymmdd" 
        :publisher-id="PublisherID"
        @close="showModal = ''" >
    </modal-publisher-cancel>

    <modal-cancel v-if="showModal === 'modalCancel'" 
        :circuit-id="CircuitID"
        :service-zone-id="ServiceZoneID"
        :service-time-id="ServiceTimeID" 
        :service-date="yyyymmdd"
        :cancel-range="CancelRange"
        @close="showModal = ''" >
    </modal-cancel>
@endsection

@section('script')
    @include('act.modalPublisherSet')
    @include('act.modalPublisherCancel')
    @include('act.modalCancel')
    @include('act.modalPush')
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
            showModal: '',
            CircuitID: "{{ session('auth.CircuitID') ?? request()->CircuitID }}",
            ServiceTimeID: null,
            ServiceZoneID: null,
            PublisherID: null,
            CancelRange: null,
        },
        watch: {
            today: function(){
                location.href = '?ServiceDate=' + this.yyyymmdd;
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
            yyyymm:function(){
                var yyyy = this.today.getFullYear();
                var mm = ('0' + (this.today.getMonth() + 1)).slice(-2);
                return yyyy + '-' + mm;
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
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
            _closeModal:function (popupName) {
                // this[popup] =false;
                this.$refs[popupName].style.display = 'none';
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
            _setParams:function (params){
                for (var key in params) {
                    this.$data[key] = params[key];
                }
            },
        }
    })
    
    </script>
@endsection
