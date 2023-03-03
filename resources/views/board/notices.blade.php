@extends('layouts.frames.master')
@section('content')
@include('layouts.sections.searchNotice')

<section class="section-table-section">
    <div class="table-responsive">
        <table class="table table-center table-font-size-90">
            <thead>
            <tr>
                <th>
                    <div class="min-width">
                        <span>No</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CITY') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.A') }}({{ __('msg.AREA') }})</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.RT') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TITLE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.WRITER') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.VIEWS') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.DATE_OF_PRE') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>


            @foreach ($NoticeList as $Notice)
                <tr class="pointer"
                    onclick="location.href = '/{{ request()->path() }}/{{ $Notice->NoticeID }}?{{ http_build_query(request()->all()) }}'">
                    <td>
                        {{ $Notice->NoticeID }}
                    </td>
                    <td>
                        {{ $Notice->MetroName }}
                    </td>
                    <td>
                        {{ $Notice->CircuitName }}
                    </td>
                    <td>
                        @if($locale === 'kr')
                            {{ $Notice->ReceiveGroup }}
                        @else
                            {{ $Notice->ReceiveGroupEng }}
                        @endif
                    </td>
                    <td class="title">
                        <div class="d-flex">
                            @if ($Notice->FileYn)
                                <div class="icon-file">
                                    <i class="fas fa-paperclip"></i>
                                </div>
                            @endif
                            <div>
                                <a>{{ $Notice->Title }}</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $Notice->AdminName }}
                    </td>
                    <td>
                        {{ $Notice->ReadCnt }}
                    </td>
                    <td>
                        {{ $Notice->CreateDate }}
                    </td>
                </tr>
            @endforeach
            @if (count($NoticeList) === 0)
                <tr>
                    <td colspan="8">{{ __('msg.NO_DATA') }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button
            type="button"
            class="btn btn-primary"
            onclick="location.href='/notices/0/form'">
            {{ __('msg.NOTICE_REG') }}
        </button>
    </div>
    {{ $NoticeList->appends( request()->all() )->links() }}
</section>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
