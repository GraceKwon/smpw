<div class="page-header">
    <h1 class="page-title">{{ $title }}</h1>
    <div class="route">
        @foreach ( session('gnb')[$title] as $path => $name)
        <a href="{{ $path }}">{{ $name }}</a>
        @endforeach
    </div>
</div>