@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">지역선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select">
                        <option selected="">선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
            <th>
                <label class="label">열람대상선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select">
                        <option selected="">선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <input type="text" class="form-control" id="register02" placeholder="제목을 입력해 주세요">
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">첨부파일</label>
            </th>
            <td colspan="3">
                <input type="file">
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">내용</label>
            </th>
            <td colspan="3">
                <textarea class="form-control" rows="10"></textarea>
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
