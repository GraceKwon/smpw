@if(isset($breadcrumb))
{{-- @php(dd($breadcrumb)) --}}
<div class="page-header">
    <h1 class="page-title">{{ $breadcrumb[ count($breadcrumb) - 1 ]['name'] }}</h1>
    <div class="route">
        <a href="/">홈</a>
            @foreach ( $breadcrumb as $menu)
                <a @if($menu['path'] !== null) href="/{{ $menu['path'] }}" @endif>{{ $menu['name'] }}</a>
            @endforeach
        </div>
    </div>
@endif
    