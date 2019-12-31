@extends('layouts.frames.master')
@section('content')
@push('slot')
<div class="search-form-item">
        <label class="label" for="CreateDate">요청일자</label>
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
                        <span>발신</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>수신</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>메시지 제목</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>발송일자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>상태</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>확인일자</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($LetterList as $Letter) 
            <tr>
                <td>
                    {{ $Letter->LetterID }}
                </td>
                <td>
                    {{ $Letter->AdminName }}
                </td>
                <td>
                    {{ $Letter->ReceiveAdminName }}
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
                        {{ $Letter->ReadYn ? '읽음' : '안읽음' }}
                    </div>
                </td>
                <td>
                    {{ $Letter->ReceiveDate }}
                </td>
            </tr>
            @endforeach
            @if (count($LetterList) === 0)
                <tr>
                    <td colspan="8">데이터가 없습니다.</td>
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
