@extends('layouts.frames.master')
@section('content')

<section class="register-section">
    <table class="table table-notice-view">
        <thead>
        <tr>
            <td>
                <div>
                    <span class="text-muted font-size-80 mr-2">[전국 / 봉사자전체]</span>
                    <span class="notice-title">국내 대표자를 위한 추천된 숙박업소 목록 업데이트</span>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <small class="text-muted">Hits : 400</small>
                    <small class="text-muted ml-3">Date : 2019-05-31</small>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="d-flex">
                    <label class="label">첨부파일</label>
                    <div>
                        <a class="file">file01.pdf</a>
                        <a class="file">file02.jpg</a>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
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
    <table class="table table-register mt-3">
        <tbody>
        <tr>
            <th>
                <label class="label">이전글</label>
            </th>
            <td>
                <a href="#">이전글</a>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">다음글</label>
            </th>
            <td>
                <a href="#">다음글</a>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button type="button" class="btn btn-outline-secondary">목록</button>
    </div> <!-- /.register-btn-area -->
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
