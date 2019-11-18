@extends('layouts.frames.master')
@section('content')

<section class="section-table-section">
    <div class="table-responsive">
    <form method="POST"
        @submit="_confirm" 
        @keydown.enter.prevent>
        @method("PUT")
        @csrf
            <table class="table table-center table-font-size-90">
                <thead>
                <tr>
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
                            <span>현재 재고량</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>변경</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    {{--  {{ dd( count( $ProductStockList) ) }}  --}}
                    @if( count( $ProductStockList) === 0)
                    <tr>
                        <td colspan="5">조회 결과가 없습니다.</td>
                    </tr>
                    @endif
                    @foreach ($ProductStockList as $ProductStock)
                    <tr>
                        <td>
                            {{ $ProductStockList->ProductKind }}
                        </td>
                        <td>
                            {{ $ProductStockList->ProductAlias }}
                        </td>
                        <td>
                            {{ $ProductStockList->ProductName }}
                        </td>
                        <td>
                            {{ $ProductStockList->StockCnt }}
                        </td>
                        <td>
                            <input type="text" 
                                class="form-control"
                                @keyup="_qty"
                                name="Qty_{{ $ProductStockList->ProductID }}">
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            </table>
            {{--  <input type="text" 
                class="form-control"
                @keypress="_qty"
                name="Qty_1">
            <input type="text" 
                class="form-control"
                @keypress="_qty"
                name="Qty_2">
            <input type="text" 
                class="form-control"
                @keypress="_qty"
                name="Qty_3">  --}}
        </form>
    </div>
    <div class="btn-flex-area justify-content-end mt-3">
        <button type="button" class="btn btn-secondary" 
            onclick="location.href = '/{{ getTopPath() }}'">취소</button>
        {{--  <button type="submit" class="btn btn-primary">
            저장</button>  --}}
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
        methods:{
            _qty: function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '')
            },
            _confirm: function (e) {
                var res = confirm('저장 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                }
                
            },

        }
    })
</script>
@endsection
