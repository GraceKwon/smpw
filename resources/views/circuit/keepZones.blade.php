@extends('layouts.frames.master')
@section('content')
<form method="GET">

    @include('layouts.sections.search', [
        'inputText' => [
            'label' => '이름',
            'id' =>'keepZoneName'
        ]
    ])

</form>
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
                        <span>관리자 이름</span>
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
                        <span>보관장소 주소</span>
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
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
                    서울 송파구 문정동 324-942 2층
                </td>
                <td>
                    2019-03-23
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary">보관장소 등록</button>
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
