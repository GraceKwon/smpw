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
                <div>010-3452-3442</div>
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
                <div>2019-12-21</div>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th>
                <label class="label">전도인이름</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register06" placeholder="이름을 입력해 주세요.">
                </div>
            </td>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div class="check-group inline-responsive">
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
                <label class="label">순회구</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="form-control">
                        <option selected>선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
            <th>
                <label class="label">회중명</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="form-control">
                        <option selected>선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">연락처</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register06" placeholder="연락처를 입력해 주세요.">

                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">경험담내용</label>
            </th>
            <td colspan="3">
                <textarea class="form-control" rows="5" placeholder="경험담 내용을 입력해 주세요"></textarea>
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
