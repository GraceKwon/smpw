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
        <label class="label" for="writer">상태</label>
        <select class="custom-select" id="writer">
            <option selected>선택</option>
            <option>전체</option>
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
                        <span>발신</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>수신</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>메시지 제목</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>수신일자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>상태</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>확인일자</span>
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-no-read">
                        안읽음
                    </div>
                </td>
                <td>
                    -
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
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
                <td class="title">
                    <div class="d-flex">
                        <div><i class="fas fa-paperclip"></i></div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    2019-05-31
                </td>
                <td>
                    <div class="state-read">
                        읽음
                    </div>
                </td>
                <td>
                    2019-09-23
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary">
            메시지 보내기
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
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
