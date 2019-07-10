<!-- 로그인 후 기본 레이아웃 -->

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">

@include('layouts.header')

<body class="body">
    <section id="wrapper-body" class="login-page">
        <section class="wrap-box">
            @include('layouts.gnb')
            <div class="content-section">
                <!-- start : content section -->
                <div class="wrap-content">
                    <div class="container-fluid">
                        <div class="row main-layout">
                            <div class="col">
                                <!-- article section -->
                                <article class="article">
                                
                                    @include('layouts.breadcrumb')
                                
                                    @yield('content')
                                
                                </article>
                                <!-- /.article -->
            
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </div> <!-- /.wrap-content -->
                <!-- end : content section -->
            </div> <!-- /.content-section -->
            @include('layouts.footer')
            
            @yield('popup')
        </section>
    </section>

    <script type="text/javascript" src="../js/function.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
</body>

</html>