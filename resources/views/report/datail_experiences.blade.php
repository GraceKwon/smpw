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
                <div>김사랑</div>
            </td>
            <th>
                <label class="label">연락처</label>
            </th>
            <td>
                <div>010-4638-3846</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">도시</label>
            </th>
            <td>
                <div>남양주</div>
            </td>
            <th>
                <label class="label">순회구</label>
            </th>
            <td>
                <div>경기18</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">작성일자</label>
            </th>
            <td colspan="3">
                <div>2019-09-23</div>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th>
                <label class="label">전도인이름</label>
            </th>
            <td>
                <div>김사랑</div>
            </td>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div>형제</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">순회</label>
            </th>
            <td>
                <div>경기18</div>
            </td>
            <th>
                <label class="label">회중명</label>
            </th>
            <td>
                <div>남양주양지</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">연락처</label>
            </th>
            <td colspan="3">
                <div>010-7634-2822</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">전도인의 설명</label>
            </th>
            <td colspan="3">
                <div>
                    <p>김사랑 형제는 약 3개월 전에 호별 봉사에서 방문한 한 집에서, 문 앞에 나온 집주인으로부터 집안으로 들어오라는 초대를 받았습니다. 집으로 들어가자 집주인인 김진지씨는 1주일 전에 있었던 자신의 경험을 김사랑 형제에게 들려 주었습니다.</p>
                    <p>(후략)</p>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" class="btn btn-success">엑셀파일다운로드</button>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-outline-secondary">목록</button>
            <button type="button" class="btn btn-secondary">수정</button>
            <button type="button" class="btn btn-primary">제출</button>
            <button type="button" class="btn btn-primary">열람내용확인</button>
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
