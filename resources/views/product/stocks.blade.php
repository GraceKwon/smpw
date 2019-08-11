@extends('layouts.frames.master')
@section('content')

<section class="search-section">
    <div class="search-form-item">
        <label class="label" for="city">도시</label>
        <select class="custom-select" id="city">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="circuits">순회구</label>
        <select class="custom-select" id="circuits">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="congregation">분류</label>
        <select class="custom-select" id="congregation">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="book">출판물명</label>
        <select class="custom-select" id="book">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="date1">배송일자</label>
        <div class="date-wrap">
            <div class="input-group">
                <input type="date" class="form-control" id="date1" placeholder="시작 날자를 선택해 주세요">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="div">~</div>
            <div class="input-group">
                <input type="date" class="form-control" id="date2" placeholder="마지막 날자를 선택해 주세요">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.search-form-item -->
    <div class="search-btn-area">
        <button type="button" class="btn btn-primary">조회</button>
    </div> <!-- /.search-btn-area -->
</section>

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
                        <span>도시</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>순회구</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>담당자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>회중</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>분류</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>약호</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>출판물명</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>수량</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>최근배송일자</span>
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
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    202
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    203
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    204
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    205
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    206
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    207
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    208
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    209
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            <tr>
                <td>
                    210
                </td>
                <td>
                    남양주
                </td>
                <td>
                    경기18
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    남양주양지
                </td>
                <td>
                    010-2485-3947
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
                <td>
                    전시대 카트
                </td>
                <td>
                    6
                </td>
                <td>
                    2019-03-23
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

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
