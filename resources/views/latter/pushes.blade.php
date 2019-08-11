@extends('layouts.frames.master')
@section('content')
<section class="search-section">
    <div class="search-form-item">
        <label class="label" for="send">발신</label>
        <select class="custom-select" id="send">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="reserve">수신</label>
        <select class="custom-select" id="reserve">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="date1">수신일자</label>
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
    </div>
    <div class="search-btn-area">
        <button type="button" class="btn btn-primary">조회</button>
    </div> <!-- /.search-btn-area -->
</section>

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
                        <span>보내는 사람</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>받는 사람</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>메시지 내용</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>발송 일시</span>
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
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    202
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    203
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    204
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    205
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    206
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    207
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    208
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    209
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            <tr>
                <td>
                    210
                </td>
                <td>
                    경기18(순감명)
                </td>
                <td>
                    지부사무실
                </td>
                <td>
                    새로운 봉사 장소가 등록되었습니다.
                </td>
                <td>
                    <span>2019-05-31</span>
                    <span>22:34:44</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary">
            푸시메시지 보내기
        </button>
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

<section class="modal-layer-container">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        푸시메시지 보내기
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content">
                    <section class="register-section">
                        <table class="table table-register">
                            <tbody>
                            <tr>
                                <th>
                                    <label class="label">보내는사람</label>
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
                                    <label class="label">받는사람</label>
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
                                    <label class="label">메시지내용</label>
                                </th>
                                <td colspan="3">
                                    <textarea class="form-control" rows="10"></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">보내기</button>
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
