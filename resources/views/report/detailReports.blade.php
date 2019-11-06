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
{{  dd($ReportList) }}
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
                <th>
                    <div class="min-width">
                        <span>보고</span>
                    </div>
                </th>
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
            <tr>
                <td>
                    201
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    202
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    203
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    204
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    205
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    206
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    207
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    208
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    209
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            <tr>
                <td>
                    210
                </td>
                <td>
                    <a>08:00-09:00</a>
                </td>
                <td>
                    X
                </td>
                <td>
                    구리역
                </td>
                <td>
                    <a>김사랑</a>
                </td>
                <td>
                    <a>3</a>
                </td>
                <td>
                    0
                </td>
                <td>
                    <a>0</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area mt-3">
        <button type="button" class="btn btn-success">
            엑셀파일 다운로드
        </button>
    </div>
    <div>
        <ul class="page">
            <li class="active"><a>1</a></li>
            <li><a>2</a></li>
            <li><a>3</a></li>
            <li><a>4</a></li>
            <li><a>5</a></li>
        </ul>
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
            popupVisible: false
        },
        watch: {
            today: function(){
                var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->MetroID }}';
                    query += '&ServiceZoneID={{ request()->ServiceZoneID }}';
                    query += '&ServiceDate=' + this.yyyymmdd;

                location.href = query;
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
        }
    })

</script>
@endsection