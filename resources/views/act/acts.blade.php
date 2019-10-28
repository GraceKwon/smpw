@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-center">
    <!-- start : common elements wrap -->
    <div class="select-date-wrap no-btn-select">
        <div class="day-area">
            <button class="arrow" @click="_prevCalendar">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year">@{{ year }}</div>
            <div class="month">@{{ month }}</div>
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
                {{-- <tr>
                    <td>
                        <div class="day sun">1</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">2</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">3</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">4</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">5</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">6</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day sat">7</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="day sun">8</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">9</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">10</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">11</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">12</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">13</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day sat">14</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="day sun">15</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">16</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">17</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">18</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">19</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">20</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day sat">21</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="day sun">22</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">23</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">24</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">25</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">26</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">27</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day sat">28</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="day sun">29</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">30</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td>
                        <div class="day">31</div>
                        <div class="cal-item">
                            <div class="cal-label">구역 수</div>
                            <i class="fas fa-map-marked-alt"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">봉사자 수</div>
                            <i class="fas fa-user-friends"></i>
                            <div class="cal-value">123</div>
                        </div>
                        <div class="cal-item">
                            <div class="cal-label">인도자</div>
                            <i class="fas fa-user-tie"></i>
                            <div class="cal-value">123</div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
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
            today: new Date(),
            ServicePlanCnt: [],
        },
        watch: {
            today: function(){
                this.getDailyServicePlanCnt();
            }
        },
        computed:{
            year: function(){
                return this.today.getFullYear();
            },
            month: function(){
                return this.today.getMonth() + 1;  
            },
        },
        mounted: function(){
            this.getDailyServicePlanCnt();
        },
        methods:{
            getDailyServicePlanCnt: function () {
                var params = {
                    params: {
                        SetMonth: this.today 
                    }
                };
                axios.get('/api/acts', params)
                    .then(function (response) {
                        this.ServicePlanCnt = response.data;
                        this._buildCalendar();
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            },
            _buildCalendar: function() {
                var nMonth = new Date(this.today.getFullYear(), this.today.getMonth(), 1);  // 이번 달의 첫째 날
                var lastDate = new Date(this.today.getFullYear(), this.today.getMonth()+1, 0); // 이번 달의 마지막 날
                var tblCalendar = this.$refs.calendar;    // 테이블 달력을 만들 테이블
                // 기존 테이블에 뿌려진 줄, 칸 삭제
                while (tblCalendar.rows.length > 1) {
                    tblCalendar.deleteRow(tblCalendar.rows.length - 1);
                }
                var row = null;
                row = tblCalendar.insertRow();
                row.className = 'h-100px'
                var cnt = 0;
                // 1일이 시작되는 칸을 맞추어 줌
                for (var i=0; i < nMonth.getDay(); i++) {
                    var cell = row.insertCell();
                    
                    cnt = cnt + 1;
                }
                
                for (var i=1; i <= lastDate.getDate(); i++) { 
                    cell = row.insertCell();
                    var divClass = 'day';
                    if(cnt % 7 == 0){ //일요일
                        divClass = 'day sun';
                    }
                    if((cnt+1) % 7 == 0){//토요일
                        divClass = 'day sat';
                    }

                    var html = '<div class="' + divClass + '">' + i + '</div>'
                    html += '<div class="cal-item">'
                    html += '<div class="cal-label">구역 수</div>'
                    html += '<i class="fas fa-map-marked-alt"></i>'
                    html += '<div class="cal-value">' + (typeof this.ServicePlanCnt[i] !== 'undefined' ? this.ServicePlanCnt[i].ServiceZoneCnt : 0) + '</div>'
                    html += '</div>'
                    html += '<div class="cal-item">'
                    html += '<div class="cal-label">봉사자 수</div>'
                    html += '<i class="fas fa-user-friends"></i>'
                    html += '<div class="cal-value">' + (typeof this.ServicePlanCnt[i] !== 'undefined' ? this.ServicePlanCnt[i].PublisherCnt : 0) + '</div>'
                    html += '</div>'
                    html += '<div class="cal-item">'
                    html += '<div class="cal-label">인도자</div>'
                    html += '<i class="fas fa-user-tie"></i>'
                    html += '<div class="cal-value">' + (typeof this.ServicePlanCnt[i] !== 'undefined' ? this.ServicePlanCnt[i].LeaderCnt : 0) + '</div>'
                    html += '</div>'
                    cell.innerHTML = html;

                    cnt = cnt + 1;
                    if (cnt%7 == 0 && i < lastDate.getDate()){
                        row = tblCalendar.insertRow();// 줄 추가
                    }
                }

            },
            _prevCalendar:function () {
                this.today = new Date(this.today.getFullYear(), this.today.getMonth() - 1, this.today.getDate());
                this._buildCalendar();
            },
            _nextCalendar:function () {
                this.today = new Date(this.today.getFullYear(), this.today.getMonth() + 1, this.today.getDate());
                this._buildCalendar();
            },
            _today:function () {
                this.today = new Date();
                this._buildCalendar();
            }
        }
    })

</script>
@endsection
