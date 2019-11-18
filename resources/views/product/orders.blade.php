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
    <label class="label" for="CreateDate">신청일자</label>
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
                        <span>순회구</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>담당자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>연락처</span>
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
                        <span>주문수량</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>신청일자</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>배송조회</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                {{--  {{ dd( count( $ProductOrderList) ) }}  --}}
                @if( count( $ProductOrderList) === 0)
                <tr>
                    <td colspan="12">조회 결과가 없습니다.</td>
                </tr>
                @endif
                @foreach ($ProductOrderList as $ProductOrder)
                <tr class="pointer"
                    onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                    <td>
                        {{ listNumbering($loop->index, 30) }}
                    </td>
                    <td>
                        {{ $ProductOrder->MetroName }}
                    </td>
                    <td>
                        {{ $ProductOrder->CircuitName }}
                    </td>
                    <td>
                        {{ $ProductOrder->AdminName }}
                    </td>
                    <td>
                        {{ $ProductOrder->Mobile }}
                    </td>
                    <td>
                        {{ $ProductOrder->ProductKind }}
                    </td>
                    <td>
                        {{ $ProductOrder->ProductAlias }}
                    </td>
                    <td>
                        {{ $ProductOrder->ProductName }}
                    </td>
                    <td>
                        {{ $ProductOrder->OrderCnt }}
                    </td>
                    <td>
                        {{ $ProductOrder->CreateDate }}
                    </td>
                    <td>
                        {{ $ProductOrder->InvoiceCode }}
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" class="btn btn-success"
                @if(!$ProductOrderList->count())
                    {{--  disabled  --}}
                @endif
                @click="_export">
                엑셀파일 다운로드
            </button>
            <button type="button" class="btn btn-info">
                송장정보입력
            </button>
        </div>
        @if(session('auth.CircuitID'))
            @include('layouts.sections.registrationButton', [
                'label' => '출판물신청',
            ])
        @endif    
    </div>
    {{ $ProductOrderList->appends( request()->all() )->links() }}

</section>

<section class="modal-layer-container" style="display :none">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        송장 정보 입력 팝업창
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content text-center">
                    <div class="table-area">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>도시</th>
                                <th>순회구</th>
                                <th>담당자</th>
                                <th>회중</th>
                                <th>연락처</th>
                                <th>신청일자</th>
                                <th>송장번호 입력</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>남양주</td>
                                <td>경기18</td>
                                <td>홍길동</td>
                                <td>남양주양지</td>
                                <td>010-1423-3232</td>
                                <td>2019-04-30</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm max-w-250px">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">확인</button>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </div>
</section>

<section class="modal-layer-container" style="display :none">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        배송 조회
                    </div>
                    <div class="mlp-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="mlp-content text-center min-w-500px-desktop">
                    <div class="table-area">
                        <table class="table table-bordered">
                            </thead>
                            <tbody>
                            <tr>
                                <th>송장번호</th>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <textarea class="form-control w-100" rows="10"></textarea>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm">닫기</button>
                    <button class="btn btn-primary btn-sm">확인</button>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </div>
</section>
@endsection

@section('popup')
    {{--  <modal-order-confirm v-if="showModal === 'modalOrderConfirm'" 
        :circuit-id="CircuitID"
        :service-date="yyyymmdd" 
        :service-time-id="ServiceTimeID" 
        :service-zone-id="ServiceZoneID"
        @close="showModal = ''" >
    </modal-order-confirm>  --}}

@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            showModal: '',
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
