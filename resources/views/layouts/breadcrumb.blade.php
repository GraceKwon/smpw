<div class="page-header">
    <h1 class="page-title">{{ isset($breadcrumb) ? $breadcrumb[count($breadcrumb) - 1] : 'Title Area'  }}</h1>
    
    <div class="route">
        <a href="/home">홈</a>
        @foreach ( isset($breadcrumb) ? $breadcrumb : ['menu','submenu'] as $name)
            <a>{{ $name }}</a>
        @endforeach
    </div>
</div>
