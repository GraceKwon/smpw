@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">보낸사람</label>
            </th>
            <td>
                <div>지부사무실</div>
            </td>
            <th>
                <label class="label">받는사람</label>
            </th>
            <td>
                <div>경기18(순회감독자)</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <div class="text-primary font-weight-bold">전시대 경험담 요청</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">첨부파일</label>
            </th>
            <td colspan="3">
                <a class="file">file-name.pdf</a>
                <a class="file">file-name.pdf</a>
                <a class="file">file-name.pdf</a>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">메시지</label>
            </th>
            <td colspan="3">
                <div>
                    <p class="font-weight-bold">추천된 숙박업소 목록 안내</p>
                    <p>
                        안녕하세요.<br/>
                        「추천된 숙박업소 목록」 (예약 가능한 숙박업소 목록)이 등록되었습니다.<br/>
                        화면 상단의 호텔리스트 메뉴를 선택(클릭) 하시거나, 첨부되어 있는 “추천된 숙박업소 목록.pdf” 파일을 다운받아 확인하실 수 있습니다.<br/>
                        해당 숙박업소 정보는 오직 국제 대회 참석을 위해 대회 기간이 포함된 기간에만 예약하실 수 있으며, 각 숙소 정보마다 예약하는 방법이 포함되어 있으니 참고하실 수 있습니다. 다만, 숙박업소와 예약을 위해 접촉하여 알게 되는 가격 정보는 다른 숙박업소나 타인에게 공유해서는 안 됩니다. 이 비용은 우리 행사를 위해 많은 자원 봉사자들이 수고하여 협의한 가격이므로, 다른 용도로 사용하는 일은 없어야 합니다.
                    </p>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end mt-3">
            <button type="button" class="btn btn-secondary">취소</button>
            <button type="button" class="btn btn-primary">메시지보내기</button>
    </div>
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
