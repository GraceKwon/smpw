<!-- start : header section -->
<header class="header">
    <section class="first-row">
        <div class="wrap-content">
            <div class="container-fluid">
                <a class="brand" href="/">
                    <img src="/img/brand/brand-logo.png" class="logo" alt="">
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
                    <div class="soc-body">
                        <nav class="nav-wrap">
                            <ul class="nav-depth-one">
                            @if( session('gnb') !== null )
                                @foreach ( session('gnb') as $title => $submenus)
                                <li @if(array_key_exists( getTopPath(), $submenus)) 
                                    class="active" 
                                @endif>
                                    <a>
                                        <span>{{ $title }}</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        @foreach ( $submenus as $path => $name )
                                        <li>
                                            <a href="/{{ $path }}">{{ $name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            @endif
                                <!-- <li>
                                    <a>
                                        <span>봉사자 관리</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">봉사자 관리</a>
                                        </li>
                                        <li>
                                            <a href="#">요일별 관리</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>봉사일정 관리</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">봉사일정 관리</a>
                                        </li>
                                        <li>
                                            <a href="#">봉사일정 생성</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>봉사보고 관리</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">봉사보고 관리</a>
                                        </li>
                                        <li>
                                            <a href="#">방문요청 관리</a>
                                        </li>
                                        <li>
                                            <a href="#">경험담 보고</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>출판물 관리</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">출판물재고 관리</a>
                                        </li>
                                        <li>
                                            <a href="#">출판물 신청</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>봉사기록 통계</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">봉사자 총계</a>
                                        </li>
                                        <li>
                                            <a href="#">봉사보고 통계</a>
                                        </li>
                                        <li>
                                            <a href="#">출판물재고 통계</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>게시판 관리</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">공지사항</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a>
                                        <span>메세지함</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <ul class="nav-depth-two">
                                        <li>
                                            <a href="#">보낸 편지함</a>
                                        </li>
                                        <li>
                                            <a href="#">받은 편지함</a>
                                        </li>
                                        <li>
                                            <a href="#">푸시메세지 발송</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> -->
                        </nav>
                        <div class="user-info-wrap">
                            <div class="login">
                                <div class="user-wrap">
                                    <div class="user-thumbnail">
                                        <img src="../img/common/user-default.png" alt="">
                                    </div>
                                    <div class="user-name">
                                        <span class="text-primary font-weight-bold">{{ session('auth.AdminName')}}</span>님
                                    </div>
                                </div>
                            </div>
                            <nav class="nav-member for-desktop">
                                <ul>
                                    <li>
                                        <a>내 정보 수정</a>
                                    </li>
                                    <li class="split">
                                        <a href="/logOut">로그아웃</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="login-info-wrap">
                                <span class="label">최근 로그인 :</span>
                                <span class="date">2019-03-02</span>
                                <span class="time">23:21:27</span>
                            </div>
                        </div>
                    </div>
                    <div class="soc-footer for-mobile">
                        <a class="btn-log">로그아웃</a>
                    </div>
                </section>
            </div> <!-- /.container -->
        </div> <!-- /.wrap-content -->
    </section>
</header> <!-- /.header -->
<!-- end : header section -->