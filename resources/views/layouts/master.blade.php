<!-- 로그인 후 기본 레이아웃 -->

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">

@include('layouts.header')

<body class="body">
    <section id="wrapper-body" class="login-page">
        <section class="wrap-box">
            @include('layouts.gnb')
            
            @yield('content')

            @include('layouts.footer')
            
            @yield('popup')
        </section>
    </section>

    <script type="text/javascript" src="../js/function.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
</body>

</html>