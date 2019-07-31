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
        <label class="label" for="congregation">회중</label>
        <select class="custom-select" id="congregation">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="name">이름</label>
        <input type="text" class="form-control" id="name" placeholder="이름을 입력해 주세요">
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="sex">성별</label>
        <select class="custom-select" id="sex">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="position">신분</label>
        <select class="custom-select" id="position">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="state">상태</label>
        <select class="custom-select" id="state">
            <option selected>선택</option>
            <option>option</option>
        </select>
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
                        <span>회중</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>이름</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>신분</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>권한</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지정요일</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지정일자</span>
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
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
                    남양주양지
                </td>
                <td>
                    김사랑
                </td>
                <td>
                    장로
                </td>
                <td>
                    010-1234-5678
                </td>
                <td>
                    보조자
                </td>
                <td>
                    토요일
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary" onclick="location.href = '/{{request()->path()}}/0'">사용자 등록</button>
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
    <!-- <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-800px">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            <span>Modal layer popup</span>
                        </div>
                        <div class="mlp-close">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content">
                        점검중입니다
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-secondary btn-sm">취소</button>
                        <button class="btn btn-primary btn-sm">확인</button>
                    </div>
                </div>
            </div> 
        </div>
    </section> -->
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
