@extends('layouts.frames.error')

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
                        <h4>- Error message -</h4>
                        <ol>
                            <li>{{ $errorMessage }}</li>
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