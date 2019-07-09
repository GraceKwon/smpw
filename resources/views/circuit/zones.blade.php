@extends('layouts.master')

@section('content')
<div class="content-section">
    <!-- start : content section -->
    <div class="wrap-content">
        <div class="container-fluid">
            <div class="row main-layout">
                <div class="col">

                    <!-- article section -->
                    <article class="article">
                        @breadcrumb(['title' => '구역 관리'])
                        <!-- <div class="page-header">
                            <h1 class="page-title">구역 관리</h1>
                            <div class="route">
                                <a>홈</a>
                                <a>순회구 관리</a>
                                <a>구역 관리</a>
                            </div>
                        </div> -->
                        @endbreadcrumb

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
                                <button type="button" class="btn btn-primary btn-responsive">구역 등록</button>
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

                    </article>
                    <!-- /.article -->

                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.wrap-content -->
    <!-- end : content section -->

</div> <!-- /.content-section -->
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


@endsection