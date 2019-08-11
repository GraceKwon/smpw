@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-center">
    <!-- start : common elements wrap -->
    <div class="select-date-wrap no-btn-select">
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
</section>

<section class="section-table-section schedule-overview">
    <div class="table-responsive">
        <table class="table table-bordered table-font-size-90">
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
            <tr>
                <td>
                    <div class="day sun">1</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">2</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">3</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">4</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">5</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">6</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day sat">7</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="day sun">8</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">9</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">10</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">11</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">12</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">13</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day sat">14</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="day sun">15</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">16</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">17</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">18</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">19</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">20</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day sat">21</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="day sun">22</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">23</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">24</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">25</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">26</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">27</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day sat">28</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="day sun">29</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">30</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td>
                    <div class="day">31</div>
                    <div class="cal-item">
                        <div class="cal-label">출판물</div>
                        <i class="fas fa-book"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">동영상</div>
                        <i class="fas fa-video"></i>
                        <div class="cal-value">123</div>
                    </div>
                    <div class="cal-item">
                        <div class="cal-label">방문요청</div>
                        <i class="fas fa-edit"></i>
                        <div class="cal-value">123</div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
