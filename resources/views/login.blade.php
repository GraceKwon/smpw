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
                                <div class="login-form-wrap no-label">
                                    <form>
                                        <div class="input-area">
                                            <div class="input-flex-group">
                                                <input type="text" id="user_id" class="form-control" placeholder="아이디를 입력해 주세요">
                                                <label for="user_id">아이디</label>
                                            </div>
                                            <div class="input-flex-group">
                                                <input type="password" id="user_pw" class="form-control" placeholder="비밀번호를 입력해 주세요">
                                                <label for="user_pw">비밀번호</label>
                                            </div>
                                        </div>
                                        <div class="btn-area mt-3">
                                            <button type="button" class="btn btn-primary btn-lg btn-block">로그인</button>
                                        </div>
                                        <div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="save_member_info">
                                                <label class="custom-control-label" for="save_member_info">
                                                    <span class="text-muted">아이디 / 비밀번호 저장</span>
                                                </label>
                                            </div>
                                            <div class="text-right">
                                                <a class="btn-ask-reset">
                                                    비밀번호 초기화 요청
                                                </a>
                                            </div>
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