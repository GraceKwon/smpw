<!-- 로그인, 첫 로그인, 첫 로그인 비밀번호 설정 레이아웃 -->

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">

<head profile="http://www.w3.org/2005/10/profile">
    
    @include('layouts.sections.header')
    <title>대도시 특별 공개증거</title>

</head>

<body class="body">
    <section id="wrapper-body" class="login-page">
        <section class="wrap-box">
            @yield('content')

            @include('layouts.sections.footer')

            @yield('popup')
        </section>
    </section>

    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/function.min.js"></script>
    <script type="text/javascript" src="/js/function.js"></script>
    @yield('script')
</body>

</html>