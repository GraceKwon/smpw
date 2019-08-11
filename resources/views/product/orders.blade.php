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
                <th></th>
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
                        <span>주문수량</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>신청일자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>배송조회</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck1">201</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck2">202</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck3">203</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                        <label class="custom-control-label" for="customCheck4"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck4">204</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                        <label class="custom-control-label" for="customCheck5"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck5">205</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck6">
                        <label class="custom-control-label" for="customCheck6"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck6">206</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck7">
                        <label class="custom-control-label" for="customCheck7"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck7">207</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck8">
                        <label class="custom-control-label" for="customCheck8"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck8">208</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                        <label class="custom-control-label" for="customCheck9"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck9">209</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck10">
                        <label class="custom-control-label" for="customCheck10"></label>
                    </div>
                </td>
                <td>
                    <label for="customCheck10">210</label>
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
                    청소년은 묻는다 – 질문과 효과있는 대답 1부
                </td>
                <td>
                    3
                </td>
                <td>
                    2019-03-23
                </td>
                <td>
                    배송전
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" class="btn btn-success">
                엑셀파일 다운로드
            </button>
            <button type="button" class="btn btn-info">
                송장정보입력
            </button>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-primary">
                출판물신청
            </button>
        </div>
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

<section class="modal-layer-container" style="display :none">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        송장 정보 입력 팝업창
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content text-center">
                    <div class="table-area">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>도시</th>
                                <th>순회구</th>
                                <th>담당자</th>
                                <th>회중</th>
                                <th>연락처</th>
                                <th>신청일자</th>
                                <th>송장번호 입력</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>남양주</td>
                                <td>경기18</td>
                                <td>홍길동</td>
                                <td>남양주양지</td>
                                <td>010-1423-3232</td>
                                <td>2019-04-30</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm max-w-250px">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">확인</button>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </div>
</section>

<section class="modal-layer-container" style="display :none">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        배송 조회
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content text-center min-w-500px-desktop">
                    <div class="table-area">
                        <table class="table table-bordered">
                            </thead>
                            <tbody>
                            <tr>
                                <th>송장번호</th>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <textarea class="form-control w-100" rows="10"></textarea>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">확인</button>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </div>
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
