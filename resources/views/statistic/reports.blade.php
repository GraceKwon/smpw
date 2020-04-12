@extends('layouts.frames.master')
@section('content')
    @push('slot')
        <div class="search-form-item">
            <label class="label">도시구분선택</label>
                <input type="radio" class="custom-radio mt-2" id="radioMetro" name="TypeID" 
                    @if(request()->TypeID === '1') checked @endif
                    value="1">
                <label class="mr-3  mt-2" for="radioMetro">도시</label>

                <input type="radio" class="custom-radio" id="radioCircuit" name="TypeID" 
                    @if(request()->TypeID === '2') checked @endif
                    value="2">
                <label class="mr-3" for="radioCircuit">도시+지역</label>
        </div> 
        {{-- <div class="search-form-item">
            <label class="label">출판물구분선택</label>
                <input type="radio" class="custom-radio mt-2" id="radioProduct" name="ProductTypeID" 
                    @if(request()->ProductTypeID === '1') checked @endif
                    value="1">
                <label class="mr-3  mt-2" for="radioProduct">출판물집계</label>

                <input type="radio" class="custom-radio" id="radioDetail" name="ProductTypeID" 
                    @if(request()->ProductTypeID === '2') checked @endif
                    value="2">
                <label class="mr-3" for="radioDetail">출판물상세</label>
        </div>  --}}
        {{-- @if(isset($LanguageList))
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
        @endif --}}
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
                <th>
                    <div class="min-width">
                        <span>도시</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>지역</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>출판물</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>동영상</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>방문요청</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>경험담</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @php($total = ['ProductCnt' => 0,'VideoCnt' => 0,'VisitRequestCnt' => 0,'ExperienceCnt' => 0])
            @foreach ($List as $row)
                @php($total['ProductCnt'] += $row->ProductCnt )
                @php($total['VideoCnt'] += $row->VideoCnt )
                @php($total['VisitRequestCnt'] += $row->VisitRequestCnt )
                @php($total['ExperienceCnt'] += $row->ExperienceCnt )
                <tr>
                    <td>
                        {{ $row->MetroName }}
                    </td>
                    <td>
                        {{ $row->CircuitName ?? '-' }}
                    </td>
                    <td>
                        {{ $row->ProductCnt }}
                    </td>
                    <td>
                        {{ $row->VideoCnt }}
                    </td>
                    <td>
                        {{ $row->VisitRequestCnt }}
                    </td>
                    <td>
                        {{ $row->ExperienceCnt }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    합계
                </td>
                <td>
                    {{ $total['ProductCnt'] }}
                </td>
                <td>
                    {{ $total['VideoCnt'] }}
                </td>
                <td>
                    {{ $total['VisitRequestCnt'] }}
                </td>
                <td>
                    {{ $total['ExperienceCnt'] }}
                </td>
            </tr>
            </tfoot>
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