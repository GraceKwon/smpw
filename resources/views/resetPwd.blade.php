@extends('layouts.frames.login')

@section('content')
<div class="content-section">

    <!-- start : content section -->
    <div class="wrap-content">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- article section -->
                    <article class="article">
                        <section class="article-wrap">

                            <!-- start : login form wrap section -->
                            <section class="login-form-section">
                                <div class="logo-wrap">
                                    <img src="../img/brand/brand-logo.png" class="logo" alt="">
                                    <div class="typo-area">
                                        <div class="font-size-120 opacity-70">여호와의 증인</div>
                                        <div class="font-size-180 font-weight-600">대도시 특별 공개증거</div>
                                    </div>
                                </div>
                                <div class="login-form-wrap">
                                    <form>
                                        <div class="text-area">
                                            <div class="font-size-120 text-primary">비밀번호 초기와를 요청하시겠습니까?</div>
                                            <div class="mt-1">아이디와 연락처 번호를 입력해 주십시오. </div>
                                        </div>
                                        <div class="border-top my-4"></div>
                                        <div class="input-area">
                                            <div class="input-flex-group">
                                                <input type="password" id="user_id" class="form-control" placeholder="사용하실 아이디를 입력해 주세요">
                                                <label for="user_id">아이디</label>
                                            </div>
                                            <div class="input-flex-group">
                                                <input type="password" id="user_mobile_num" class="form-control" placeholder="연락처 번호를 입력해 주세요">
                                                <label for="user_mobile_num">연락처 번호</label>
                                            </div>
                                        </div>
                                        <div class="btn-area text-right mt-3">
                                            <button type="button" class="btn btn-secondary">취소</button>
                                            <button type="button" class="btn btn-primary">확인</button>
                                        </div>
                                    </form>
                                </div> <!-- /.login-form-wrap -->
                            </section> <!-- /.login-form-section -->
                            <!-- end : login form wrap section -->

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