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
                                    <div class="font-size-120 opacity-70">{{ __('msg.JW') }}</div>
                                    <div class="font-size-180 font-weight-600">{{ __('msg.SMPW') }}</div>
                                </div>
                            </div>
                            @error('fail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="login-form-wrap">
                                <form id="form" method="POST" @submit="validate">
                                    @method("PUT")
                                    @csrf
                                    <div class="text-area">
                                        <div class="font-size-120 text-primary">{{ __('msg.LOGIN_FIRST') }}</div>
                                        <div class="mt-1">{{ __('msg.PW_USE') }}</div>
                                    </div>
                                    <div class="border-top my-4"></div>
                                    <div class="input-area">
                                        <div class="input-flex-group">
                                            <input type="password"
                                                ref="UserPassword"
                                                id="UserPassword"
                                                name="UserPassword"
                                                v-model="UserPassword"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid' : errors.has('UserPassword'),
                                                    'is-valid' : !errors.has('UserPassword') && UserPassword
                                                }"
                                                v-validate="{
                                                    rules: {
                                                        required: true,
                                                        regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,12}$/,
                                                    }
                                                }"
                                                placeholder="{{ __('msg.PW_USE') }}">
                                            <label for="UserPassword">{{ __('msg.USER_PW') }}</label>
                                            <div class="invalid-feedback">{{ __('msg.PW_VALIDATION') }}</div>
                                        </div>
                                        <div class="input-flex-group">
                                            <input type="password"
                                                id="UserPassword_confirmation"
                                                name="UserPassword_confirmation"
                                                v-model="UserPassword_confirmation"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid' : errors.has('UserPassword_confirmation'),
                                                    'is-valid' : !errors.has('UserPassword_confirmation') &&  UserPassword_confirmation
                                                }"
                                                v-validate="'required|confirmed:UserPassword'"
                                                placeholder="{{ __('msg.PW_AGAIN') }}">
                                            <label for="UserPassword_confirmation">{{ __('msg.PW_RE') }}</label>
                                            <div class="invalid-feedback">{{ __('msg.PW_ABOVE') }}</div>
                                        </div>
                                    </div>
                                    <div class="btn-area text-right mt-3">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="location.href = '/'">{{ __('msg.CANCEL') }}</button>
                                        <button class="btn btn-primary">{{ __('msg.CONFIRM') }}</button>
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
@section('script')
<script>
    var app = new Vue({
    el: '#form',
        data: {
            UserPassword: '',
            UserPassword_confirmation: ''
        },
        methods: {
            validate: function (e) {
                // return true;
                this.$validator.validateAll()
                .then(function (result) {
                    console.log(result);
                    if (!result) {
                        e.preventDefault();
                    }
                })
                .catch(function (error) {
                    e.preventDefault();
                });


            }
        }
    })
</script>
@endsection

@section('popup')
    {{-- <section class="modal-layer-container">
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
    </section> --}}
@endsection
