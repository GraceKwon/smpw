@extends('layouts.frames.master')
@section('content')
@if( !session('auth.CircuitID') && !request()->CircuitID )
    <div class="alert alert-danger">{{ __('msg.NO_DIST') }}</div>
@endif
@include('layouts.sections.searchCalendar')
<section class="calender-section justify-content-center">
    <!-- start : common elements wrap -->
    <div class="select-date-wrap">
        <div class="day-area">
        @foreach ($days as $i => $day)
            @if($yoil == $i)
            <button class="btn btn-secondary btn-sm mr-1">
                {{ request()->ServiceDate }}&nbsp;{{ $day }}
            </button>
            @else
            <button class="btn btn-outline-secondary btn-sm mr-1"             
                onclick="location.href = `?MetroID={{ request()->MetroID }}&CircuitID={{ request()->CircuitID }}&ServiceDate={{ date('Y-m-d', strtotime(request()->ServiceDate.' '.$i-$yoil.' day')) }}`;">
                {{ $day }}
            </button>
            @endif
        @endforeach
        </div>
    </div>
    <!-- end : common elements wrap -->
</section>

<section class="section-table-section schedule-detail">
    <div class="table-responsive">
        <table class="table table-bordered table-striped-even table-font-size-90">
            <thead>
                @if( !empty($ServiceTimeList) )
                <tr>
                    <th class="text-center">
                        <div class="min-width">
                            <span>{{ __('msg.ST') }}</span>
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
                    <div class="territory-name" style="height:auto;padding-top:0;">
                        {{ $ArrayTimeID['ZoneName'] ?? ''}}
                    </div>
                </td>
                @for($time = $min ; $time <= $max ; $time ++)
                <td>
                    <div class="publisher-area" style="height:auto;">
                    @if(isset($ServicePlanDetail[$ServiceZoneID][$time]))
                        <ul>
                            @foreach($ServicePlanDetail[$ServiceZoneID][$time] as $Publisher)
                            <li>
                                <div class="name pointer @if($Publisher->LeaderYn) introducer @endif" 
                                onclick="location.href = '/publishers/{{ $Publisher->PublisherID }}'">
                                    {{  $Publisher->PublisherName }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
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
        mixins: [datepickerLang],
        data:{
            today: new Date('{{ request()->ServiceDate }}'),
            popupVisible: false,
            showModal: '',
            CircuitID: "{{ session('auth.CircuitID') ?? request()->CircuitID }}",
            ServiceTimeID: null,
            ServiceTime: null,
            ServiceZoneID: null,
            PublisherID: null,
            CancelRange: null,
            ZoneName: null,
            PushUrl: null
      },
    //   mounted() {
    //     // Use console.log for debugging
    //     console.log('Component mounted:', this.today);
    //   },
        watch: {
            // today: function(){
            //     location.href = '?ServiceDate=' + this.yyyymmdd;
            // },
            popupVisible: function(){
                this.$refs.datepicker.showPopup();
            },
            today: function(){
                location.href = '?MetroID={{ request()->MetroID }}&CircuitID={{ request()->CircuitID }}&ServiceDate=' + this.yyyymmdd;
            }
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
                var yyyy = today.getFullYear();
                var mm = ('0' + (today.getMonth() + 1)).slice(-2);
                var dd = ('0' + today.getDate()).slice(-2);
                today = new Date(yyyy + '-' + mm + '-' + dd);
                if( this.today.getTime() >= today.getTime() ) return false

                return true;
            }
        },
        methods:{
            _setParams:function (params){
                for (var key in params) {
                    this.$data[key] = params[key];
                }
            },
            
        }
    })

    </script>
@endsection
