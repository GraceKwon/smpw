
{{-- 
<!DOCTYPE html>

<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="@Url.Content("~/images/logo_144px.png")" />
    <link rel="stylesheet" type="text/css" href="/css/style.min.css" />
    <title>App 업데이트 - JW Public Witnessing</title>

</head>

<body id="bodyCF">
    <div id="wrap">
        <div class="dl_title">
            <div class="dl_txt_title">
                <span class="txt_jw">여호와의 증인</span><br>
                <span class="txt_smpw">대도시 특별</span>&nbsp;<span class="txt_smpw_n">공개증거</span>
            </div><!--//dl_txt_title-->
        </div><!--//dl_title-->

        <div class="dl_title_intro">
            <div class="dl_txt_intro">
                <span class="txt_point">
                    "새 버전을 설치해 주시기 바랍니다.<br>
                    만일 설치가 되지 않으면 기존에 설치된 앱을 삭제한 후 다시 설치해 주시기 바랍니다."<br>
                </span> 
                <br><br>
                대도시 특별 공개증거 프로그램이<br>
                새 버전으로 업그레이드 되었습니다.<br>
                아래에서 본인의 휴대폰 기종에 맞는 것을<br>
                설치해 주시기 바랍니다.
            </div><!--//dl_title_intro-->
        </div><!--//dl_txt_intro-->

        <div class="dl_con">
            <div class="dl_txt_con">
                <div class="dl_div_icon">
                    <a href="/app/smpw.apk">
                        <img src="@Url.Content("~/images/android.png")" class="dl_icon" />
                        <span class="txt_b">안드로이드용 설치</span>
                    </a>
                </div>
                <div class="dl_div_icon">
                    <a href="itms-services://?action=download-manifest&amp;url=https://8smw.org/app/smpw.plist"> -->
                        <img src="@Url.Content("~/images/ios.png")" class="dl_icon" />
                        <span class="txt_b txt_wid">iOS용 설치</span>
                    </a>
                </div>
            </div><!--//dl_txt_con-->
        </div><!--//dl_con-->

        <div id="dl_footer">
            JW SPECIAL METROPOLITAN PUBLIC WITNESSING
        </div><!--//dl_footer-->
    </div><!--//wrap-->

</body>

</html> --}}

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
                                        <div class="font-size-180 font-weight-600">앱 다운로드</div>
                                    </div>
                                </div>
                                <div class="logo-wrap">
                                    대도시 특별 공개증거 봉사자용 앱이<br>
                                    새 버전으로 업그레이드 되었습니다.<br>
                                    아래에서 본인의 휴대폰 기종에 맞는 것을<br>
                                    설치해 주시기 바랍니다.
                                </div>
                                <div class="login-form-wrap no-label">
                                    <div class="logo-wrap" style="padding:0">
                                        <a href="/app/smpw.apk">
                                            <img src="../img/android.png" alt="">
                                        </a>
                                        <a href="/app/smpw.apk">
                                            <div class="typo-area">
                                                <div class="font-size-120 opacity-70">안드로이드용</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="login-form-wrap no-label">
                                    <div class="logo-wrap" style="padding:0">
                                        <a href="itms-services://?action=download-manifest&amp;url=https://8smw.org/app/smpw.plist">
                                            <img src="../img/apple.png" alt="">
                                        </a>
                                        <a href="itms-services://?action=download-manifest&amp;url=https://8smw.org/app/smpw.plist">
                                            <div class="typo-area">
                                                <div class="font-size-120 opacity-70">iOS용 앱</div>
                                            </div>
                                        </a>
                                    </div>
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
@endsection