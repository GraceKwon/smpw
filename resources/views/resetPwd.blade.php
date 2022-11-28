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
                                    <div class="alert alert-danger">{!! $message !!}</div>
                                @enderror
                                <div class="login-form-wrap">
                                    <form id="form" method="POST" @submit="validate">
                                        @method("PUT")
                                        @csrf
                                        <div class="text-area">
                                            <div class="font-size-120 text-primary">{{ __('msg.PW_RESET') }}</div>
                                            <div class="mt-1">{{ __('msg.ID_PHONE_INPUT') }}</div>
                                        </div>
                                        <div class="border-top my-4"></div>
                                        <div class="input-area">
                                            <div class="input-flex-group">
                                                <input type="text"
                                                    id="Account"
                                                    name="Account"
                                                    v-model="Account"
                                                    class="form-control"
                                                    :class="{ 'is-invalid' : errors.has('Account') }"
                                                    v-validate="'required'"
                                                    placeholder="{{ __('msg.ID_USE') }}">
                                                <label for="Account">{{ __('msg.ID') }}</label>
                                                <div class="invalid-feedback">{{ __('msg.ID_INPUT') }}</div>
                                            </div>
                                            <div class="input-flex-group">
                                                <input type="text"
                                                    id="Mobile"
                                                    name="Mobile"
                                                    v-model="Mobile"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid' : errors.has('Mobile'),
                                                        'is-valid' : !errors.has('Mobile') && Mobile
                                                    }"
                                                    v-validate="{
                                                        rules: {
                                                            required: true,
                                                            regex:/^\d{2,3}-\d{3,4}-\d{4}$/,
                                                        }
                                                    }"
                                                    placeholder="연락처 번호를 입력해 주세요">
                                                <label for="Mobile">{{ __('msg.PN') }}</label>
                                                <div class="info-feedback">{{ __('msg.ONLY_NUMBER') }}</div>
                                            </div>
                                        </div>
                                        <div class="btn-area text-right mt-3">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="location.href='/login'">{{ __('msg.CANCEL') }}</button>
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
            Account: '',
            Mobile: ''
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            }
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

            },
        }
    })
</script>
@endsection
