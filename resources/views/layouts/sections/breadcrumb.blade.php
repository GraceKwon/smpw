@if(isset($breadcrumb))
{{-- @php(dd($breadcrumb)) --}}
<div class="page-header">
    <h1 class="page-title">{{ $breadcrumb[ count($breadcrumb) - 1 ]['name'] }}</h1>
    <div class="route">
        <a href="/">{{ __('msg.HOME') }}</a>
            @foreach ( $breadcrumb as $menu)
                <a @if($menu['path'] !== null) href="/{{ $menu['path'] }}" @endif>{{ __($menu['name']) }}</a>
            @endforeach
        </div>
    </div>
@endif
