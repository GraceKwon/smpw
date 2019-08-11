@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label" for="register01">아이디</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register01" placeholder="자동으로 생성됩니다" disabled>
                </div>
            </td>
            <th rowspan="5">
                <label class="label" for="register01">사진</label>
            </th>
            <td rowspan="5">
                <div class="photo-container">
                    <div class="photo-wrap">
                        <img src="../img/demo/demo-profile-thumbnail.png" class="thumbnail">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register02">이름</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register02" placeholder="이름을 입력해 주세요">
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register03">회중</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select" id="register03">
                        <option selected>선택</option>
                        <option>서울 북부 회중</option>
                        <option>서울 중부 회중</option>
                        <option>서울 남부 회중</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio0101" class="custom-control-input" name="radio01">
                        <label class="custom-control-label" for="radio0101">형제</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio0102" class="custom-control-input" name="radio01">
                        <label class="custom-control-label" for="radio0102">자매</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register04">연락처</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register04" placeholder="연락처를 입력해 주세요">
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register05">봉사자 신분</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select" id="register05">
                        <option selected>선택</option>
                        <option>장로</option>
                        <option>봉사의종</option>
                        <option>전도인</option>
                    </select>
                </div>
            </td>
            <th>
                <label class="label" for="register06">봉사자 특권</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select" id="register06">
                        <option selected>선택</option>
                        <option>정규 파이오니아</option>
                        <option>특별 파이오니아</option>
                        <option>순회감독자</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">봉사상태</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio0201" class="custom-control-input" name="radio02">
                        <label class="custom-control-label" for="radio0201">봉사중</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio0202" class="custom-control-input" name="radio02">
                        <label class="custom-control-label" for="radio0202">일시중단</label>
                    </div>
                </div>
            </td>
            <th>
                <label class="label">지원가능여부</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="check-group inline-responsive">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="radio0301" class="custom-control-input" name="radio03">
                            <label class="custom-control-label" for="radio0301">가능</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="radio0302" class="custom-control-input" name="radio03">
                            <label class="custom-control-label" for="radio0302">불가능</label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register07">메모</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <textarea type="text" class="form-control w-100" id="register07" rows="5" placeholder="메모를 입력해 주세요."></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register08">계정중단일</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="input-group max-w-250px-desktop">
                        <input type="date" class="form-control" id="register08" placeholder="날자를 선택해 주세요">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <th>
                <label class="label" for="register09">계정중단사유</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select" id="register09">
                        <option selected>선택</option>
                        <option>본인중단</option>
                        <option>자격상실</option>
                        <option>이사</option>
                        <option>사망</option>
                        <option>기타</option>
                    </select>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button type="button" class="btn btn-secondary">취소</button>
        <button type="button" class="btn btn-primary">저장</button>
    </div> <!-- /.register-btn-area -->
</section>

<section class="table-section mt-6">
    <h4 class="text-primary">봉사 타임 지정</h4>
    <div class="info-area form-inline mt-3">
        <select class="custom-select">
            <option selected>월요일</option>
            <option>화요일</option>
            <option>수요일</option>
            <option>목요일</option>
            <option>금요일</option>
            <option>토요일</option>
            <option>일요일</option>
        </select>
        <div class="form-control bg-primary border-primary text-white mt-1 mt-sm-0 ml-sm-2">2타임 배정</div>
    </div>
    <div class="table-area table-responsive mt-2">
        <table class="table table-bordered table-center font-size-90">
            <thead>
            <tr>
                <th>
                    <label class="label">봉사타임</label>
                </th>
                <th>
                    <div class="min-w-100px">
                        <label class="label">구역명1</label>
                    </div>
                </th>
                <th>
                    <div class="min-w-100px">
                        <label class="label">구역명2</label>
                    </div>
                </th>
                <th>
                    <div class="min-w-100px">
                        <label class="label">구역명3</label>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <label class="label">06:00~07:00</label>
                </th>
                <td class="state-publisher-wait">
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option>미지정</option>
                            <option selected>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td class="state-publisher-set">
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option>미지정</option>
                            <option>대기자</option>
                            <option selected>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td class="state-publisher-leader">
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option selected>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">07:00~08:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">08:00~09:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">09:00~10:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">10:00~11:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">11:00~12:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">12:00~13:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>  <tr>
                <th>
                    <label class="label">13:00~14:00</label>
                </th>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
                <td>
                    <div class="form-inline">
                        <select class="custom-select mx-auto">
                            <option selected>미지정</option>
                            <option>대기자</option>
                            <option>봉사자</option>
                            <option>인도자</option>
                        </select>
                    </div>
                    <div class="mt-1 font-size-80">[0/6]</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="form-inline align-items-center mt-3">
        <div class="min-w-140px text-primary">스케줄 변경 시작일</div>
        <div class="input-group mt-2 mt-md-0">
            <input type="date" class="form-control" placeholder="날자를 선택해 주세요">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-2 mt-md-0 ml-md-2">스케쥴 변경</button>
    </div>
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
