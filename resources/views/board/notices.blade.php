@extends('layouts.frames.master')
@section('content')
<section class="search-section">
    <div class="search-form-item">
        <label class="label" for="city">지역</label>
        <select class="custom-select" id="city">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="circuits">대상</label>
        <select class="custom-select" id="circuits">
            <option selected>선택</option>
            <option>option</option>
        </select>
    </div> <!-- /.search-form-item -->
    <div class="search-form-item">
        <label class="label" for="writer">작성자</label>
        <select class="custom-select" id="writer">
            <option selected>선택</option>
            <option>전체</option>
        </select>
    </div> <!-- /.search-form-item -->
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
                        <span>열람지역</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>열람대상</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>제목</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>작성자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>조회수</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>작성일자</span>
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
                    인천
                </td>
                <td>
                    전체
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
                </td>
                <td>
                    2019-09-23
                </td>
            </tr>
            <tr>
                <td>
                    202
                </td>
                <td>
                    인천
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                            <i class="fas fa-paperclip"></i>
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
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
                    전체
                </td>
                <td>
                    조정장로
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                        </div>
                        <div>새로운 봉사 장소가 등록되었습니다</div>
                    </div>
                </td>
                <td>
                    윤성훈 (순회감독자)
                </td>
                <td>
                    2
                </td>
                <td>
                    2019-09-23
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-primary" onclick="location.href='/notices/0/form'">
            공지사항 등록
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
