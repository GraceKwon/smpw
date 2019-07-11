@extends('layouts.frames.master')
@section('content')
    <section class="section-table-wrap edit-circuits-territory-list">
        <div class="table-responsive">
            <table class="table table-center table-font-size-90">
                <thead>
                <tr>
                    <th>
                        <div class="min-width">
                            <span>우선 순위</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>구역 명칭</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>구역 약호</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>등록자</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>등록 일자</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        3
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        4
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        5
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        6
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        7
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        8
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        9
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                <tr>
                    <td>
                        10
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        구리역
                    </td>
                    <td>
                        조정 장로
                    </td>
                    <td>
                        2019-03-02
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-area text-right mt-3">
            <a href="{{request()->path()}}/0">
                <button type="button" class="btn btn-primary btn-responsive" id="register">구역 등록</button>
            </a>
        </div>
        <!--start pagination -->
        <div>
            {{-- {{ $json->links() }} --}}
        </div>
        <!-- end pagination -->
        

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
