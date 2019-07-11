<div class="page-header">
    <h1 class="page-title">{{ isset($breadcrumb) ? $breadcrumb[ count($breadcrumb) - 1 ]['name'] : 'Title Area'  }}</h1>
    
    <div class="route">
        <a href="/home">홈</a>
        @foreach ( isset($breadcrumb) ? $breadcrumb : [ [null ,'menu'], [null,'submenu'] ,[null,'subpage'] ] as $menu)
            <a @if($menu['path'] !== null) href="/{{ $menu['path'] }}" @endif>{{ $menu['name'] }}</a>
        @endforeach
    </div>
</div>
