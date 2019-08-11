@extends('layouts.frames.master')
@section('content')
<section class="calender-section justify-content-between">
    <div>
        <button class="btn btn-primary btn-sm">요일봉사취소</button>
    </div>
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

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
