@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
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
                <label class="label">신청자이름</label>
            </th>
            <td>
                <div>김사랑</div>
            </td>
            <th>
                <label class="label">연락처</label>
            </th>
            <td>
                <div>010-3049-3937</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">신청일자</label>
            </th>
            <td colspan="3">
                <div>2019-12-21</div>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th>
                <label class="label">출판물선택</label>
            </th>
            <td>
                청소년들이 궁금해 하는 10가지 질문
            </td>
            <th>
                <label class="label">현재재고량</label>
            </th>
            <td>
                132
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">분류</label>
            </th>
            <td></td>
            <th>
                <label class="label">신청수량</label>
            </th>
            <td>
                21
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">약호</label>
            </th>
            <td></td>
            <th>
                <label class="label">수령 후 재고량</label>
            </th>
            <td>
                52
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th>
                <label class="label">출판물선택</label>
            </th>
            <td>
                청소년들이 궁금해 하는 10가지 질문
            </td>
            <th>
                <label class="label">현재재고량</label>
            </th>
            <td>
                132
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">분류</label>
            </th>
            <td></td>
            <th>
                <label class="label">신청수량</label>
            </th>
            <td>
                43
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">약호</label>
            </th>
            <td></td>
            <th>
                <label class="label">수령 후 재고량</label>
            </th>
            <td>
                52
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th>
                <label class="label">송장번호</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <input type="text" class="form-control" placeholder="송장번호를 입력해 주세요.">
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
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
