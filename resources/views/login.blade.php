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
                                @error('fail')
                                    <div class="alert alert-danger">{!! $message !!}</div>
                                @enderror
                                <div class="login-form-wrap no-label">
                                    <form id="form" method="POST" @submit="setCookie">@csrf
                                        <div class="input-area">
                                            <div class="input-flex-group">
                                                <input type="text" id="Account" name="Account" 
                                                    ref="Account"
                                                    class="form-control @error('Account') is-invalid @enderror" 
                                                    value="{{ old('Account') }}"
                                                    placeholder="아이디를 입력해 주세요">
                                                <label for="Account">아이디</label>
                                                <div class="invalid-feedback">아이디를 입력해 주세요</div>
                                            </div>
                                            <div class="input-flex-group">
                                                <input type="password" id="UserPassword" name="UserPassword" 
                                                    ref="UserPassword"
                                                    class="form-control @error('UserPassword') is-invalid @enderror" 
                                                    value="{{ old('UserPassword') }}"
                                                    placeholder="비밀번호를 입력해 주세요">
                                                <label for="UserPassword">비밀번호</label>
                                                <div class="invalid-feedback">비밀번호를 입력해 주세요</div>
                                            </div>
                                        </div>
                                        <div class="btn-area mt-3">
                                            <button class="btn btn-primary btn-lg btn-block">로그인</button>
                                        </div>
                                        <div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" 
                                                    name="Remember"
                                                    ref="Remember"
                                                    {{-- @if(old('Remember')) checked @endif --}}
                                                    id="save_member_info">
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
@endsection

@section('popup')
{{-- @error('fail')
<section class="modal-layer-container" v-if="popup">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-300px">
                <div class="mlp-content text-center">
                    <img src="../img/exclamation.svg" class="w-50px">
                    <div class="mt-3">
                        {!! $message !!}
                    </div>
                </div>
                <div class="mlp-footer justify-content-center">
                    <button class="btn btn-primary btn-sm"
                        @click="closePopup">확인</button>
                </div>
            </div>
        </div> <!-- /.mlp-wrap -->
    </div>
</section>
@enderror --}}
@endsection

@section('script')
<script>
    var app = new Vue({
    el: '#wrapper-body',
        data: {
            popup: true
        },
        mounted: function () {
            if(this.$refs.Account.value === ""){
                this.$refs.Account.value = this.$cookie.get("Account");
            }
            
            if(this.$refs.UserPassword.value === ""){
                this.$refs.UserPassword.value = this.$cookie.get("UserPassword");
            }
            
            
            if(this.$cookie.get("Account")){
                this.$refs.Remember.checked = true;
            }
        },
        methods: {
            setCookie: function () {
                if(this.$refs.Remember.checked){
                    this.$cookie.set("Account", this.$refs.Account.value);
                    this.$cookie.set("UserPassword", this.$refs.UserPassword.value);
                }
                
                if(!this.$refs.Remember.checked){
                    this.$cookie.delete("Account");
                    this.$cookie.delete("UserPassword");
                }
                
            },
            closePopup: function () {
                this.popup = false;
                
            }

        }
    })
</script>
@endsection

