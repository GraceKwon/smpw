@extends('layouts.frames.master')
@section('content')
@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">발송일자</label>
        <date-picker
            v-model="CreateDate"
            :input-id="'CreateDate'"
            :input-name="'CreateDate'"
            :input-class="'form-control'"
            :value-type="'format'"
            :icon-day="31"
            {{-- :clearable="false" --}}
            :lang="lang"
            :range="true"
            width="260"
            >
        </date-picker>
</div> <!-- /.search-form-item -->
@endpush
@include('layouts.sections.search', [
    'selectBoxs' => [
        [
            'label' => '상태',
            'id' => 'ReadYn',
            'options' => [
                [
                    'label' => '읽음',
                    'value' => '1',
                ],
                [
                    'label' => '안읽음',
                    'value' => '0',
                ]
            ]
        ]
    ]
])

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
                        <span>{{ __('msg.SENDING') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.RECEIVE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.MSG_TITLE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.SEND_DATE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.STATUS') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CONFIRM_DATE') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($LetterList as $Letter)
            <tr class="pointer"
                onclick="location.href='/inbox/{{ $Letter->LetterID }}'">
                <td>
                    {{ $Letter->LetterID }}
                </td>
                <td>
                    {{ $Letter->AdminName }}
                    @if ($Letter->AdminRoleID > 2)
                        <br>
                        <small>
                            ( {{ $Letter->MetroName . ' > ' . $Letter->CircuitName . ' > ' . $Letter->AdminRole }} )
                        </small>
                    @endif
                </td>
                <td>
                    {{ $Letter->ReceiveAdminName }}
                    @if ($Letter->rAdminRoleID > 2)
                        <br>
                        <small>
                            ( {{ $Letter->rMetroName . ' > ' . $Letter->rCircuitName . ' > ' . $Letter->rAdminRole }} )
                        </small>
                    @endif
                </td>
                <td class="title">
                    <div class="d-flex">
                        <div class="icon-file">
                        </div>
                        <div>{{ $Letter->Title }}</div>
                    </div>
                </td>
                <td>
                    {{ $Letter->CreateDate }}
                </td>
                <td>
                    <div class="state-no-read">
                        {{ $Letter->ReadYn ? __('msg.READ') : __('msg.UNREAD') }}
                    </div>
                </td>
                <td>
                    {{ $Letter->ReceiveDate }}
                </td>
            </tr>
            @endforeach
            @if (count($LetterList) === 0)
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
            onclick="location.href='/sent/0'">
            메시지 보내기
        </button>
    </div>
    {{ $LetterList->appends( request()->all() )->links() }}

</section>
@endsection

@section('popup')
@endsection

@section('script')
    <script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            CreateDate: [
                    '{{ request()->StartDate }}',
                    '{{ request()->EndDate }}',
                ],
        }
    })

</script>
@endsection
