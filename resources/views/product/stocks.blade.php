@extends('layouts.frames.master')
@section('content')

@push('slot')
@if(isset($ProductList))
<div class="search-form-item">
    <label class="label" for="ServiceZoneID">출판물명</label>
    <select class="custom-select" id="" name="ProductID" onchange="submit()">
        <option value="">전체</option>
        @foreach ($ProductList as $Product)
            <option @if(request()->ProductID == $Product->ProductID ) selected @endif
            value="{{ $Product->ProductID }}">{{ $Product->ProductName }}</option>
        @endforeach
    </select>
</div> <!-- /.search-form-item -->
@endif
<div class="search-form-item">
    <label class="label" for="CreateDate">최근배송일자</label>
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
                        <span>분류</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>약호</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>출판물명</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>수량</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>최근배송일자</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                {{--  {{ dd( count( $ProductStockList) ) }}  --}}
                @if( count( $ProductStockList) === 0)
                <tr>
                    <td colspan="11">조회 결과가 없습니다.</td>
                </tr>
                @endif
                @foreach ($ProductStockList as $ProductStock)
                <tr>
                    <td>
                        {{ listNumbering($loop->index, 30) }}
                    </td>
                    <td>
                        {{ $ProductStock->MetroName }}
                    </td>
                    <td>
                        {{ $ProductStock->CircuitName }}
                    </td>
                    <td>
                        {{ $ProductStock->ProductKind }}
                    </td>
                    <td>
                        {{ $ProductStock->ProductAlias }}
                    </td>
                    <td>
                        {{ $ProductStock->ProductName }}
                    </td>
                    <td>
                        {{ $ProductStock->StockCnt }}
                    </td>
                    <td>
                        {{ $ProductStock->ReceiptDate }}
                    </td>
                </tr>
                @endforeach
        </tbody>
        </table>
    </div>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" 
                class="btn btn-success"
                @if(!$ProductStockList->count())
                    {{--  disabled  --}}
                @endif
                @click="_export">
                엑셀파일 다운로드
            </button>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-primary"
            onclick="location.href='/{{ request()->path() }}/modify'">
                재고수량관리</button>
        </div>
    </div>
    {{ $ProductStockList->appends( request()->all() )->links() }}

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
                    query += '&CircuitID={{ request()->MetroID }}';
                    query += '&ProductID={{ request()->ProductID }}';
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
