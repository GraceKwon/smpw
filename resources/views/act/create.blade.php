@extends('layouts.frames.master')
@section('content')
<section class="section-wrap schedule-reset">
    <div class="notice">
        <div>선택한 일자 이후로 기존에 생성된 모든 일정이 삭제되고 다시 생성됩니다.</div>
        <div>일정 생성은 신중히 진행해 주시기 바랍니다.</div>
    </div>
    <div class="item-wrap">
        <label class="label">일정 재생성 시작일</label>
        <div class="input-group max-w-250px-desktop">
            <input type="date" class="form-control" placeholder="날자를 선택해 주세요">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </div>
            </div>
        </div>
        <div class="btn-area">
            <button class="btn btn-primary">일정생성</button>
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
