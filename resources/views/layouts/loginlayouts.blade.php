<!-- 로그인, 첫 로그인, 첫 로그인 비밀번호 설정 레이아웃 -->

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">

@include('layouts.header')

<body class="body">
    <section id="wrapper-body" class="login-page">
        <section class="wrap-box">
            @yield('content')

            @include('layouts.footer')

            @yield('popup')
        </section>
    </section>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/function.min.js"></script>
</body>

</html>