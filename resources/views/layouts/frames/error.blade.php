<!-- 로그인, 첫 로그인, 첫 로그인 비밀번호 설정 레이아웃 -->

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">

<head profile="http://www.w3.org/2005/10/profile">
    
    @include('layouts.sections.header')
    <title>대도시 특별 공개증거 - ERROR</title>

</head>

<body class="body">
    <section id="wrapper-body" class="login-page">
        <section class="wrap-box">
            <!-- start : header section -->
            <header class="header">
                <section class="first-row">
                    <div class="wrap-content">
                        <div class="container-fluid">
                            <a class="brand" href="/home">
                                <img src="../img/brand/brand-logo.png" class="logo" alt="">
                            </a>
                            <div class="slogan for-desktop">
                                여호와의 증인 <span class="font-weight-600">대도시 특별 공개증거</span>
                            </div>
                            <div class="icon-wrap for-mobile">
                                <div class="btn-top-toggle angle-toggle">
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div> <!-- /.container -->
                    </div> <!-- /.wrap-content -->
                </section>
                <section class="second-row">
                    <div class="wrap-content">
                        <div class="container-fluid">
                            <section class="soc-container">
                            
                            
                            </section>
                        </div> <!-- /.container -->
                    </div> <!-- /.wrap-content -->
                </section>
            </header> <!-- /.header -->
            <!-- end : header section -->
            @yield('content')

            @include('layouts.sections.footer')

        </section>
    </section>

</body>

</html>