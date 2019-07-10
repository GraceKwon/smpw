@extends('layouts.master')

@section('content')
<div class="content-section">
    <!-- start : content section -->
    <div class="wrap-content">
        <div class="container-fluid">
            <div class="row main-layout">
                <div class="col">
                    <!-- article section -->
                    <article class="article">

                        <h1>ERROR</h1>
                        <h5>권한이 없습니다.</h5>
                        <ol>
                            <li>요청하신 페이지는 권한이 없는 페이지 입니다.</li>
                        </ol>

                    </article>
                    <!-- /.article -->

                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.wrap-content -->
    <!-- end : content section -->

</div> <!-- /.content-section -->
@endsection