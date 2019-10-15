@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-between">
    <div>
        <button class="btn btn-primary btn-sm">요일봉사취소</button>
    </div>
    <!-- start : common elements wrap -->
    <div class="select-date-wrap">
        <div class="day-area">
            <button class="arrow" @click="_prevDate">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="year">@{{ year }}</div>
            <div class="month">@{{ month }}</div>
            <div class="day">@{{ day }}</div>
            <div class="weekday">@{{ weekday }}</div>
            <button class="arrow" @click="_nextDate">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>
        <div class="btn-area">
            {{-- <button class="btn btn-outline-secondary btn-today btn-sm">
                <i class="far fa-calendar-check"></i>
            </button> --}}
            <input type="date" class="form-control" :value="yyyymmdd" @change="_changeDate" placeholder="날자를 선택해 주세요">
            <button class="btn btn-outline-secondary btn-today btn-sm"
                @click="_today">
                오늘
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
                    <div class="min-width sun">
                        <span>봉사타임</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>06:00-07:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>07:00-08:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>08:00-09:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>09:00-10:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>10:00-11:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>11:00-12:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>12:00-13:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>13:00-14:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>14:00-15:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>15:00-16:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width">
                        <span>16:00-17:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>17:00-18:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>18:00-19:00</span>
                    </div>
                </th>
                <th class="text-center">
                    <div class="min-width sat">
                        <span>19:00-20:00</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="territory-name">
                        구역명1
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-danger btn-block btn-sm">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm">
                            지원요청하기
                        </button>
                    </div>
                </td>
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
            </tr>
            <tr>
                <td>
                    <div class="territory-name">
                        구역명1
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-danger btn-block btn-sm">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm">
                            지원요청하기
                        </button>
                    </div>
                </td>
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
            </tr>
            <tr>
                <td>
                    <div class="territory-name">
                        구역명1
                    </div>
                    <div class="btn-area">
                        <button class="btn btn-outline-danger btn-block btn-sm">
                            구역봉사취소
                        </button>
                        <button class="btn btn-outline-primary btn-block btn-sm">
                            지원요청하기
                        </button>
                    </div>
                </td>
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
                <td>
                    <div class="publisher-area">
                        <ul>
                            <li>
                                <div class="name introducer">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
                            <li>
                                <div class="name">최증인</div>
                                <div class="del">
                                    <i class="fas fa-times"></i>
                                </div>
                            </li>
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
            </tr>
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
                week: ['일', '월', '화', '수', '목', '금', '토']
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
                }
            }
        })
    
    </script>
@endsection
