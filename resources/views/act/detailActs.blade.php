@extends('layouts.frames.master')
@section('content')
@if(!count($ServicePlanDetail))
    <div class="alert alert-danger">봉사일정이 없습니다.</div>
@endif
<section class="calender-section justify-content-between">
    <div class="container-cancel">
        <button class="btn btn-danger btn-sm"
            @if(count($ServicePlanDetail) == 0)
                disabled
            @endif
            @click="_setParams({
                CancelRange: 'today',
            });_showModal('modalCancel')">
            요일봉사취소</button>
    </div>
    <!-- start : common elements wrap -->
    <div class="select-date-wrap">
        <div class="day-area">
            <button type="button" class="arrow" @click="_prevDate">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year" v-html="year"></div>
            <div class="month" v-html="month"></div>
            <div class="day" v-html="day"></div>
            <div class="weekday" v-html="weekday"></div>
            <button type="button" class="arrow" @click="_nextDate">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>
        <div class="btn-area">
            <date-picker 
                v-model="today" 
                :input-name="'ServiceDate'"
                width="0"
                ref="datepicker" 
                :clearable="false"
                :input-class="'hide'" 
                :lang="lang" 
                >
            </date-picker>
            <button class="btn btn-outline-secondary btn-today btn-sm"
                type="button"
                @click="popupVisible = !popupVisible">
                <i class="far fa-calendar-alt"></i>
            </button>
        </div>
    </div>
    <!-- end : common elements wrap -->
    <div class="container-ask">
        <button class="btn btn-primary btn-sm" 
            :disabled="Passing"
            @click="_setParams({
                ZoneName: '전체',
                });_showModal('modalPush')">지원요청하기</button>
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
                            @if(empty($ServicePlanDetail[$ServiceZoneID]))
                                disabled
                            @endif
                            @click="_setParams({
                                ServiceZoneID: '{{$ServiceZoneID}}',
                                CancelRange: 'zone',
                            });_showModal('modalCancel')">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm" 
                            :disabled="Passing"
                            @click="_setParams({
                                ServiceZoneID: '{{$ServiceZoneID}}',
                                ZoneName: '{{ $ArrayTimeID['ZoneName'] }}',
                                });_showModal('modalPush')">
                            지원요청하기
                        </button>
                    </div>
                </td>
                @for($time = $min ; $time <= $max ; $time ++)
                <td>
                    <div class="publisher-area">
                    @if(isset($ServicePlanDetail[$ServiceZoneID][$time]))
                        <ul>
                            @foreach($ServicePlanDetail[$ServiceZoneID][$time] as $Publisher)
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
                            @if( isset($ServicePlanDetail[$ServiceZoneID][$time]) && count($ServicePlanDetail[$ServiceZoneID][$time]) > 5)
                                disabled
                            @endif
                            @click="_setParams({
                                    ServiceZoneID: '{{ $ServiceZoneID }}',
                                    ServiceTimeID: '{{ $ArrayTimeID[$time] }}',
                                });
                                _showModal('modalPublisherSet')">
                            임의배정
                        </button>
                        <button class="btn btn-outline-danger btn-block btn-sm" 
                            @if(empty($ServicePlanDetail[$ServiceZoneID][$time]))
                                disabled
                            @endif
                            @click="_setParams({
                                    ServiceZoneID: '{{ $ServiceZoneID }}',
                                    ServiceTimeID: '{{ $ArrayTimeID[$time] }}',
                                    CancelRange: 'time',
                                });
                                _showModal('modalCancel')">
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

    <modal-push v-if="showModal === 'modalPush'" 
        :circuit-id="CircuitID"
        :service-zone-id="ServiceZoneID"
        :service-date="yyyymmdd"
        :zone-name="ZoneName"
        @close="showModal = ''" >
    </modal-push>
@endsection

@section('script')
    @include('act.modalPublisherSet')
    @include('act.modalPublisherCancel')
    @include('act.modalCancel')
    @include('act.modalPush')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            today: new Date('{{ request()->ServiceDate }}'),
            popupVisible: false,
            showModal: '',
            CircuitID: "{{ session('auth.CircuitID') ?? request()->CircuitID }}",
            ServiceTimeID: null,
            ServiceZoneID: null,
            PublisherID: null,
            CancelRange: null,
            ZoneName: null
        },
        watch: {
            today: function(){
                location.href = '?ServiceDate=' + this.yyyymmdd;
            },
            popupVisible: function(){
                this.$refs.datepicker.showPopup();
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
                return this.lang.days[this.today.getDay()];  
            },
            yyyymmdd:function(){
                var yyyy = this.today.getFullYear();
                var mm = ('0' + (this.today.getMonth() + 1)).slice(-2);
                var dd = ('0' + this.today.getDate()).slice(-2);
                return yyyy + '-' + mm + '-' + dd;
            },
            Passing: function(){
                var today = new Date();
                if( this.today.getFullYear() >= today.getFullYear()) return false;
                else if( this.today.getMonth() >= today.getMonth()) return false;
                else if( this.today.getDate() >= today.getDate()) return false;
                else
                return true;
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
            _showModal:function (modalName) {
                this.showModal = modalName;
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
