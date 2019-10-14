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

{{-- @section('popup')
<section class="modal-layer-container">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        보고된 출판물 목록
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content text-center">
                    <div class="table-area">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>도시</th>
                                <td>남양주</td>
                                <th>순회구</th>
                                <td>경기18</td>
                            </tr>
                            <tr>
                                <th>담당자</th>
                                <td>김사랑</td>
                                <th>회중</th>
                                <td>남양주양지</td>
                            </tr>
                            <tr>
                                <th>연락처</th>
                                <td>010-2342-3948</td>
                                <th>신청일자</th>
                                <td>2019-04-30</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-area mt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>도시</th>
                                <th>순회구</th>
                                <th>언어</th>
                                <th>출판물분류</th>
                                <th>출판물이름</th>
                                <th>수량</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>서울</td>
                                <td>서울1</td>
                                <td>한국어</td>
                                <td>서적</td>
                                <td>청소년은 묻는다 – 질문과 효과있는 대답 1권
                                </td>
                                <td>1</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                </div>
            </div>
        </div> <!-- /.mlp-wrap -->
    </div>
</section>
@endsection --}}

{{-- @section('script')
<script>
</script>
@endsection --}}
