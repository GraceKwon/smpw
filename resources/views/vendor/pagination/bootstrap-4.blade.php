@if ($paginator->hasPages())
<div>
    <ul class="page">
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><a>{{ $element }}</a></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    {{-- @if ($page == $paginator->currentPage()) --}}
                    @if ($page == request()->input('page', '1'))
                        <li class="active"><a>{{ $page }}</a></li>
                    @else
                        <li><a href="/{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
@endif