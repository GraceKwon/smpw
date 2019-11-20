@extends('layouts.frames.master')
@section('content')

<section class="section-table-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    <form method="POST"
        @submit="_confirm" 
        @keydown.enter.prevent>
        @method("PUT")
        @csrf
        <div class="table-responsive">
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
                            <input type="hidden"
                                name="StockCnt[]"
                                value="{{ $ProductStock->StockCnt }}">
                        </td>
                        <td>
                            <input type="text" 
                                class="form-control"
                                @keyup="_qty"
                                name="Qty[]">
                            <input type="hidden"
                                name="ProductID[]"
                                value="{{ $ProductStock->ProductID }}">
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            </table>
        </div>
        <div class="btn-flex-area justify-content-end mt-3">
            <button type="button" class="btn btn-secondary" 
            onclick="location.href = '/{{ getTopPath() }}'">취소</button>
            <button type="submit" class="btn btn-primary">
                저장</button> 
        </div>
    </form>
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
