@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">작성자이름</label>
            </th>
            <td>
                <div>{{ $VisitRequest->PublisherName }}</div>
            </td>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div>{{ $VisitRequest->PublisherGender }}</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">도시</label>
            </th>
            <td>
                <div>{{ $VisitRequest->MetroName }}</div>
            </td>
            <th>
                <label class="label">지역</label>
            </th>
            <td>
                <div>{{ $VisitRequest->CircuitName }}</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">회중</label>
            </th>
            <td>
                <div>{{ $VisitRequest->CongregationName }}</div>
            </td>
            <th>
                <label class="label">연락처</label>
            </th>
            <td>
                <div>{{ $VisitRequest->CongregationName }}</div>
            </td>
        </tr>
        {{-- </tbody>
        <tbody> --}}
            <tr>
                <th>
                    <label class="label">관심자이름</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
                <th>
                    <label class="label">성별</label>
                </th>
                <td>
                    <div class="check-group inline-responsive">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="radio0101" class="custom-control-input" name="radio01">
                            <label class="custom-control-label" for="radio0101">남</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="radio0102" class="custom-control-input" name="radio01">
                            <label class="custom-control-label" for="radio0102">여</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">국가</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select">
                            <option selected>한국</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
                <th>
                    <label class="label">시/도</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select">
                            <option selected>경기도</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">도시</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select">
                            <option selected>남양주</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
                <th>
                    <label class="label">기본주소</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">상세 주소1</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
                <th>
                    <label class="label">상세 주소2</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">우편번호</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
                <th>
                    <label class="label">연락처</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">이메일</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" value="2019-06-01">
                    </div>
                </td>
                <th>
                    <label class="label">연락원하는시간</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select">
                            <option selected>금요일</option>
                            <option>option</option>
                        </select>
                        <select class="custom-select">
                            <option selected>오후 2:00</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">작성일자</label>
                </th>
                <td>
                    <div>2019-05-31</div>
                </td>
                <th>
                    <label class="label">처리일자</label>
                </th>
                <td>
                    <div>2019-06-01</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">전도인의 설명</label>
                </th>
                <td colspan="3">
                    <textarea class="form-control" rows="3">전시대에서 출판물에 관심을 보여 잡지에 주의를 이끌었고 10년쯤 전에 전도인의 방문을 받은 경험이 있었는데 좋은 기억으로 남아 있다고 하여 방문을 제안하니 흔쾌히 동의하고 연락처를 알려 주었습니다.</textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" class="btn btn-outline-secondary">목록</button>
            <button type="button" class="btn btn-secondary">수정</button>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-primary">보조자확인</button>
            <button type="button" class="btn btn-primary">전달처리</button>
        </div>
    </div>
</section>
@endsection



{{-- @section('script')
<script>
</script>
@endsection --}}
