@extends('layouts.frames.master')
@section('content')
@push('slot')

    <div class="search-form-item">
        <label class="label">출판물구분선택</label>
            <input type="radio" class="custom-radio mt-2" id="radioProduct" name="TypeID" 
                @if(request()->TypeID === '1') checked @endif
                value="1">
            <label class="mr-3  mt-2" for="radioProduct">출판물상세</label>

            <input type="radio" class="custom-radio" id="radioLang" name="TypeID" 
                @if(request()->TypeID === '2') checked @endif
                value="2">
            <label class="mr-3" for="radioLang">언어상세</label>
    </div> 
    @if(isset($LanguageList))
    <div class="search-form-item">
        <label class="label" for="LanguageName">언어</label>
        <select class="custom-select" 
            id="LanguageName" name="LanguageName" 
            onchange="submit()">
            <option value="">전체</option>
            @foreach ($LanguageList as $Language)
                <option @if(request()->LanguageName == $Language->LanguageName ) selected @endif
                value="{{ $Language->LanguageName }}">{{ $Language->LanguageName }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif
    <div class="search-form-item">
        <label class="label" for="CreateDate">집계기간</label>
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
@include('layouts.sections.search')

<section class="section-table-section">
    <div class="table-responsive">
        <table class="table table-center table-font-size-90">
            <thead>
            <tr>
                {{-- <th>
                    <div class="min-width">
                        <span>도시</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지역</span>
                    </div>
                </th> --}}
                @if(request()->TypeID === '1')
                <th>
                    <div class="min-width">
                        <span>출판물</span>
                    </div>
                </th>
                @endif
                <th>
                    <div class="min-width">
                        <span>언어</span>
                    </div>
                </th>
                @if(request()->TypeID === '1')
                <th>
                    <div class="min-width">
                        <span>배부/방영</span>
                    </div>
                </th>
                @endif
                @if(request()->TypeID === '2')
                <th>
                    <div class="min-width">
                        <span>출판물배부</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>동영상방영</span>
                    </div>
                </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($List as $row)
            <tr>
                {{-- <td>
                    {{ $row->MetroName ?? '전체' }}
                </td>
                <td>
                    {{ $row->CircuitName ?? '전체' }}
                </td> --}}
                @if(request()->TypeID === '1')
                <td>
                    {{ $row->ProductName }}
                </td>
                @endif
                <td>
                    {{ $row->LanguageName ?? '전체' }}
                </td>
                <td>
                    {{ $row->ProductQty }}
                </td>
                @if(request()->TypeID === '2')
                <td>
                    {{ $row->VideoQty }}
                </td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area mt-3">
        <button type="button" class="btn btn-success"
            @if(!count($List))
                disabled
            @endif
            @click="_export"
        >
            엑셀파일 다운로드
        </button>
    </div>
    
</section>
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
        },
        computed:{
            query: function () {
                var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->CircuitID }}';
                    query += '&TypeID={{ request()->TypeID }}';
                    query += '&LanguageName={{ request()->LanguageName }}';
                    query += '&StartDate=' + this.CreateDate[0];
                    query += '&EndDate=' + this.CreateDate[1];
                return query;
            }
        },
        methods:{
            _export:function () {
                location.href = '/{{ request()->path() }}/export' + this.query;
            },
        }
    })
</script>
@endsection