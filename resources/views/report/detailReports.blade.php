@extends('layouts.frames.master')
@section('content')
    @push('slot')
        <div class="search-form-date">
            <!-- start : common elements wrap -->
            <div class="select-date-wrap">
                <div class="day-area">
                    <button class="arrow">
                        <i class="fas fa-angle-left"></i>
                    </button>
                    <div class="year">@{{year}}</div>
                    <div class="month">@{{month}}</div>
                    <div class="day">@{{day}}</div>
                    <div class="weekday">@{{weekday}}</div>
                    <button class="arrow">
                        <i class="fas fa-angle-right"></i>
                    </button>
                </div>
                <div class="btn-area">
                    <date-picker v-model="today" 
                        width="1"
                        value-type="date" 
                        ref="datepicker" 
                        :clearable="false"
                        :input-class="'hide'" 
                        :lang="lang" 
                        {{-- :range="true" --}}
                        >
                    </date-picker>
                    <button class="btn btn-outline-secondary btn-today btn-sm"
                        type="button"
                        @click="popupVisible = !popupVisible">
                        <i class="far fa-calendar-check"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-select btn-sm">
                        <i class="far fa-calendar-alt"></i>
                    </button>
                </div>
            </div>
            <!-- end : common elements wrap -->
        </div> <!-- /.search-form-item -->
    @endpush
    @include('layouts.sections.search', [])
        
{{-- <section class="search-section">
    <div class="search-form-item">
        <label class="label" for="city">도시</label>
        <select class="custom-select" id="city">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="circuits">지역</label>
        <select class="custom-select" id="circuits">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="territory">구역</label>
        <select class="custom-select" id="territory">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-date">
        <!-- start : common elements wrap -->
        <div class="select-date-wrap">
            <div class="day-area">
                <button class="arrow">
                    <i class="fas fa-angle-left"></i>
                </button>
                <div class="year">2019</div>
                <div class="month">05</div>
                <div class="day">31</div>
                <div class="weekday">월요일</div>
                <button class="arrow">
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>
            <div class="btn-area">
                <button class="btn btn-outline-secondary btn-today btn-sm">
                    <i class="far fa-calendar-check"></i>
                </button>
                <button class="btn btn-outline-secondary btn-select btn-sm">
                    <i class="far fa-calendar-alt"></i>
                </button>
            </div>
        </div>
        <!-- end : common elements wrap -->
    </div> <!-- /.search-form-item -->
    <div class="search-btn-area">
        <button type="button" class="btn btn-primary">조회</button>
    </div> <!-- /.search-btn-area -->
</section> --}}

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
{{-- <script src="https://cdn.jsdelivr.net/npm/vue2-datepicker@2.13.0/lib/index.min.js"></script> --}}
<script>
// Vue.use(DatePicker.default);
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            value1: '',
            lang: {
                days: ['일', '월', '화', '수', '목', '금', '토'],
                months: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                pickers: ['다음 7일', '다음 30일', '이전 7일', '이전 30일'],
                placeholder: {
                    date: '날짜를 선택해주세요',
                    dateRange: '기간을 선택해주세요'
                }
            },
            popupVisible: false,
            today: new Date(),
            week: ['일', '월', '화', '수', '목', '금', '토']
        },
        watch:{
            popupVisible: function(){
                if(this.popupVisible){
                    this.$refs.datepicker.showPopup();
                }else{
                    this.$refs.datepicker.closePopup();
                }
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
            },
        }
    })

</script>
@endsection