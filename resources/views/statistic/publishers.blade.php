@extends('layouts.frames.master')
@section('content')
    @push('slot')
        <div class="search-form-item">
            <label class="label">집계 조건</label>
                <input type="radio" class="custom-radio mt-2" id="radioMetro" name="TypeID" 
                    @if(request()->TypeID === '1') checked @endif
                    value="1">
                <label class="mr-3  mt-2" for="radioMetro">도시</label>

                <input type="radio" class="custom-radio" id="radioCircuit" name="TypeID" 
                    @if(request()->TypeID === '2') checked @endif
                    value="2">
                <label class="mr-3" for="radioCircuit">도시+지역</label>

                <input type="radio" id="radioCong" name="TypeID" 
                    @if(request()->TypeID === '3') checked @endif
                    value="3">
                <label class="mr-3" for="radioCong">도시+지역+회중</label>
        </div> 
    @endpush    
    @include('layouts.sections.search')
                
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
                            <span>회중</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>형제</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>자매</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>졍규</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>고정봉사자</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>1년내참여자</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>장기미참여자</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StatisticListList as $StatisticList)
                <tr>
                    <td>
                        {{ ($loop->index + 1) + request()->paginate * (request()->input('page', '1')-1) }}
                    </td>
                    <td>
                        {{ $StatisticList->MetroName }}
                    </td>
                    <td>
                        {{ $StatisticList->CircuitName ?? '-' }}
                    </td>
                    <td>
                        {{ $StatisticList->CongregationName ?? '-' }}
                    </td>
                    <td>
                        {{ $StatisticList->BrotherCnt }}
                    </td>
                    <td>
                        {{ $StatisticList->SisterCnt }}
                    </td>
                    <td>
                        {{ $StatisticList->PioneerCnt }}
                    </td>
                    <td>
                        {{ $StatisticList->FixedCnt }}
                    </td>
                    <td>
                        {{ $StatisticList->OneYearCnt }}
                    </td>
                    <td>
                        {{ $StatisticList->AllCnt - $StatisticList->OneYearCnt }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-flex-area mt-3" id="bb">
        <button type="button" class="btn btn-success"
            @if(!$StatisticListList->count())
                disabled
            @endif
            @click="_export"
        >
            엑셀파일 다운로드
        </button>
    </div>
    {{ $StatisticListList->appends( request()->all() )->links() }}

</section>
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{},
        computed:{
            query: function () {
                var query = '?TypeID={{ request()->TypeID }}';
                    query += '&MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->CircuitID }}';
                    query += '&CongregationID={{ request()->CongregationID }}';
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