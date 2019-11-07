@extends('layouts.frames.master')
@section('content')
    @push('slot')
        <div class="search-form-date">
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
        </div> <!-- /.search-form-item -->
    @endpush
    @include('layouts.sections.search', [])
{{-- {{  dd( $ReportList->count() ) }} --}}
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
                        <span>시간대</span>
                    </div>
                </th>
                {{-- <th>
                    <div class="min-width">
                        <span>보고</span>
                    </div>
                </th> --}}
                <th>
                    <div class="min-width">
                        <span>구역</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>보고자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>출판물</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>동영상</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>방문요청</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($ReportList as $Report)
                <tr>
                    <td>
                        {{ ($loop->index + 1) + ( (request()->input('page', 1)-1) * 30 ) }}
                    </td>
                    <td>
                        <a>{{ sprintfServiceTime( $Report->ServiceTime ) }}</a>
                    </td>
                    {{-- <td>
                        X
                    </td> --}}
                    <td>
                        {{ $Report->ZoneName }}
                    </td>
                    <td>
                        <a>{{ $Report->PublisherName }}</a>
                    </td>
                    <td>
                        <a>{{ $Report->PlacementQty }}</a>
                    </td>
                    <td>
                        {{ $Report->VideoShowQty }}
                    </td>
                    <td>
                        <a>{{ $Report->VisitRequestQty }}</a>
                    </td>
                </tr>
                @endforeach
                @if(!$ReportList->count())
                <tr>
                    <td colspan="7">조회 결과가 없습니다.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area mt-3">
        <button type="button" class="btn btn-success"
            @if(!$ReportList->count())
                disabled
            @endif
            @click="_export">
            엑셀파일 다운로드
        </button>
    </div>
    {{ $ReportList->appends( request()->all() )->links() }}

</section>

@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            today: new Date('{{ request()->ServiceDate }}'),
            popupVisible: false
        },
        watch: {
            today: function(){
                location.href = this.query;
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
            query: function () {
                var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->MetroID }}';
                    query += '&ServiceZoneID={{ request()->ServiceZoneID }}';
                    query += '&ServiceDate=' + this.yyyymmdd;
                return query;
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
            _export:function () {
                location.href = 'export' + this.query;
            },
        }
    })

</script>
@endsection