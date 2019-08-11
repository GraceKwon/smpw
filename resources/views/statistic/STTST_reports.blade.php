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
        <label class="label" for="type1">도시구분선택</label>
        <select class="custom-select" id="type1">
            <option selected>선택</option>
            <option>도시집계</option>
            <option>도시+순회구집계</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="type2">출판물구분선택</label>
        <select class="custom-select" id="type2">
            <option selected>선택</option>
            <option>출판물집계</option>
            <option>출판물상세</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="type3">언어구분선택</label>
        <select class="custom-select" id="type3">
            <option selected>선택</option>
            <option>언어집계</option>
            <option>언어별상세</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item d-none">
        <label class="label" for="type4">언어별상세</label>
        <select class="custom-select" id="type4">
            <option selected>선택</option>
            <option>한국어</option>
            <option>영어</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="date1">기간지정</label>
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
    </div>
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
                        <span>언어</span>
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
                <th>
                    <div class="min-width">
                        <span>경험담</span>
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
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
                    한국어
                </td>
                <td>
                    5
                </td>
                <td>
                    2
                </td>
                <td>
                    3
                </td>
                <td>
                    7
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    합계
                </td>
                <td>
                    45
                </td>
                <td>
                    30
                </td>
                <td>
                    15
                </td>
                <td>
                    15
                </td>
            </tr>
            </tfoot>
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
