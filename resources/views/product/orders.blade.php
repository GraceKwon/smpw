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
                </th>
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
                <tr ref="{{ $ProductOrder->ProductOrderID }}">
                    <td>
                        <input name="ProductOrderID[]"
                            type="checkbox" 
                            value="{{ $ProductOrder->ProductOrderID }}" @change="_change">
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ listNumbering($loop->index, 30) }}
                    </td>
                    <td class="MetroName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->MetroName }}
                    </td>
                    <td class="CircuitName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->CircuitName }}
                    </td>
                    <td class="AdminName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->AdminName }}
                    </td>
                    <td class="Mobile pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->Mobile }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductKind }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductAlias }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductName }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->OrderCnt }}
                    </td>
                    <td class="CreateDate pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->CreateDate }}
                    </td>
                    <td class="pointer"
                        @click="tracks = '{{ $ProductOrder->InvoiceCode }}'">
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
                @endif
                @click="_export">
                엑셀파일 다운로드
            </button>
            <button type="button" class="btn btn-info"
                :disabled="checkedRow.length === 0"
                @click="_showModal('modalInvoiceCode')">
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

@endsection

@section('popup')
<modal-invoice-code v-if="showModal === 'modalInvoiceCode'" 
    :array="checkedRow"
    @submit="_setInvoiceCode"
    @close="showModal = ''">
</modal-invoice-code>
<modal-delivery-tracking v-if="showModal === 'modalDeliveryTracking'" 
    :tracks="tracks"
    @close="showModal = ''">
</modal-delivery-tracking>
@endsection

@section('script')
@include('product.modalInvoiceCode')
@include('product.modalDeliveryTracking')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            showModal: '',
            tracks: '',
            CreateDate: [
                '{{ request()->StartDate }}', 
                '{{ request()->EndDate }}', 
            ],
            checkedRow: [],
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
        watch: {
            tracks: function () {
                if(this.tracks !== '');
                    this._showModal('modalDeliveryTracking');
            }
        },
        methods:{
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
            _export:function () {
                location.href = '/{{ request()->path() }}/export' + this.query;
            },
            _change:function (e) {
                if(e.target.checked)
                    this.checkedRow.push(Number(e.target.value))
                else{
                    var idx = this.checkedRow.indexOf(Number(e.target.value)) 
                    if (idx > -1) this.checkedRow.splice(idx, 1)

                }  
                this.checkedRow.sort(function(a, b) { // 내림차순
                    return b - a;
                });
            },
            _setInvoiceCode:function (InvoiceCode) {
                var formData = {
                    InvoiceCode: InvoiceCode,
                    ProductOrderID: this.checkedRow
                }
                axios.post('{{ request()->path() }}', formData)
                    .then(function (response) {
                        // console.log(response);
                        location.reload()
                    })
                    .catch(function (error) {
                        alert('실패했습니다.')
                        console.log(error);
                        console.log(error.response);
                    });
                // this.$refs.form.submit();
                // location.href = '/{{ request()->path() }}/export' + this.query;
            },
        }
    })
</script>
@endsection
