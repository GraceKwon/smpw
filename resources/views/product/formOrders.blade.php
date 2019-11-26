@extends('layouts.frames.master')
@section('content')
@error('fail')
    <div class="alert alert-danger">{!! $message !!}</div>
@enderror
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section class="register-section">
    <form method="POST"
        ref="form"
        @keydown.enter.prevent>
        @method("PUT")
        @csrf
        <table class="table table-register">
            <tbody>
            <tr>
                <th>
                    <label class="label">도시</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->MetroName ?? getMetroName() }}</div>
                </td>
                <th>
                    <label class="label">지역</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->CircuitName ?? getCircuitName() }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">신청자이름</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->AdminName ?? session('auth.AdminName')}}</div>
                </td>
                <th>
                    <label class="label">연락처</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->Mobile ?? getMobile() }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">신청일자</label>
                </th>
                <td colspan="3">
                    <div>{{ $ProductOrder->CreateDate ?? date('Y-m-d')}}</div>
                </td>
            </tr>
            </tbody>
            <tbody :class="{ off : !modify }"
                v-for="(row, index) in array">
                <tr>
                    <th>
                        <label class="label">출판물선택</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <select class="custom-select" 
                                name="ProductID[]"
                                v-model="row.ProductID" 
                                :disabled="!modify"
                                @change="_getProductStock(index)"
                                >
                                <option value="">선택</option>
                                @foreach ($ProductList as $Product)
                                    <option 
                                        value="{{ $Product->ProductID }}">{{ $Product->ProductName }}</option>
                                @endforeach
                            </select>
                            @if(empty($ProductOrder->ProductOrderID))
                            <button class="btn btn-outline-secondary"
                                type="button"
                                @click="_removeRow(index)">삭제</button>
                            @endif
                        </div>
                    </td>
                    <th>
                        <label class="label">현재재고량</label>
                    </th>
                    <td 
                    @if( empty($ProductOrder->InvoiceCode) )
                        v-html="row.StockCnt"
                    @endif>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">분류</label>
                    </th>
                    <td v-html="row.ProductKind"></td>
                    <th>
                        <label class="label">신청수량</label>
                    </th>
                    <td>
                        <div class="d-flex max-w-300px-desktop">
                            <input type="text" 
                                name="OrderCnt[]"
                                v-model="row.OrderCnt"
                                :disabled="!modify"
                                @keyup="_qty(index)"
                                class="form-control"
                                placeholder="수량을 입력해 주세요.">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">약호</label>
                    </th>
                    <td v-html="row.ProductAlias"></td>
                    <th>
                        <label class="label">수령 후 재고량</label>
                    </th>
                    <td 
                    @if( empty($ProductOrder->InvoiceCode) )
                        v-html="_sumQty(index)" 
                    @endif>
                    </td>
                </tr>
                <tbody @if( session('auth.AdminRoleID') !== 2) class="off" @endif>
                    @if(isset($ProductOrder->ProductOrderID))
                    <tr v-if="!modify">
                        <th>
                            <label class="label">송장번호</label>
                        </th>
                        <td colspan="3">
                            <div class="d-flex max-w-300px-desktop">
                                <input type="text" 
                                    name="InvoiceCode"
                                    v-model="InvoiceCode"
                                    class="form-control"
                                    @if( session('auth.AdminRoleID') !== 2)
                                        readonly
                                    @else
                                        placeholder="송장번호를 입력해주세요."
                                    @endif
                                    >
                                    {{ gettype( session('auth.AdminRoleID') ) }}
                                    {{ session('auth.AdminRoleID') }}
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </tbody>
        </table>
        @if(empty($ProductOrder->ProductOrderID))
        <div class="text-center mt-2">
            <button class="btn btn-outline-secondary"
                type="button"
                @click="_addRow">+ 출판물 추가</button>
        </div>
        @endif
        <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
            {{--  <div class="btn-flex-area justify-content-end">  --}}
            <div class="d-flex">
                @if(isset($ProductOrder->ProductOrderID) 
                    && empty($ProductOrder->InvoiceCode)
                    && session('auth.AdminRoleID') !== 2)
                <button type="button" 
                    class="btn btn-secondary"
                    v-if="!modify"
                    @click="modify = true">수정</button>
                <button class="btn btn-outline-secondary"
                    type="button"
                    v-if="modify"
                    @click="this.location.reload()">취소</button>
                @endif
            </div>  
            <div class="d-flex">
                <button type="button" class="btn btn-secondary"
                    onclick="location.href='/{{ getTopPath() }}'">
                    {{ isset($ProductOrder->ProductOrderID) ? '목록' : '취소' }}
                </button>
                <button type="button" 
                    class="btn btn-primary"
                    v-if="modify"
                    @click="_confirm">저장</button>
                @if(isset($ProductOrder->ProductOrderID) 
                    && empty($ProductOrder->InvoiceCode)
                    && session('auth.AdminRoleID') !== 2)
                    <button type="button" class="btn btn-point-sub"
                        v-if="!modify"
                        @click="_delete">삭제</button>
                @elseif(session('auth.AdminRoleID') === 2)
                    <button type="submit" class="btn btn-point-sub">저장</button>
                @endif
            </div>  
        </div> <!-- /.register-btn-area -->
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
</section>
@endsection
@section('popup')
    <modal-order-comfirm v-if="showModal === 'modalOrderConfirm'" 
        :array="array"
        @submit="_submit"
        @close="showModal = ''">
    </modal-order-confirm>
@endsection
@section('script')
@include('product.modalOrderConfirm')
<script>
    var app = new Vue({
        el: '#wrapper-body',
        data: {
            showModal: '',
            modify: {{ isset($ProductOrder->ProductOrderID) ? 'false' : 'true' }},
            array: [
                {
                    ProductID: "{{ $ProductOrder->ProductID ?? '' }}",
                    ProductName: "{{ $ProductOrder->ProductName ?? '' }}",
                    ProductKind: "{{ $ProductOrder->ProductKind ?? '' }}",
                    ProductAlias: "{{ $ProductOrder->ProductAlias ?? '' }}",
                    StockCnt: "{{ $ProductOrder->StockCnt ?? '' }}",
                    OrderCnt: "{{ $ProductOrder->OrderCnt ?? '' }}",
                }
            ],
            InvoiceCode: "{{ $ProductOrder->InvoiceCode ?? '' }}"
        },
        watch: {
            Mobile: function() {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods: {
            _confirm: function(e) {
                this._showModal('modalOrderConfirm');
            },
            _submit: function() {
                this.$refs.form.submit()
            },
            _getProductStock: function(index){
                if( this._checkExist(index) < 0){
                    
                    var formData = {
                        CircuitID: "{{ session('auth.CircuitID') ?? $ProductOrder->CircuitID }}",
                        ProductID: this.array[index].ProductID,
                    };
                    axios.post('/getProductStock', formData)
                        .then(function (response) {
                            console.log(response.data);
                            if(response.data.length)
                                for (var key in response.data[0]) {
                                    this.array[index][key] = response.data[0][key];
                                }
                            else
                                for (var key in this.array[index]) {
                                        this.array[index][key] = '';
                                    }
                        }.bind(this))
                        .catch(function (error) {
                            console.log(error);
                        });
                }else{
                    for (var key in this.array[index]) {
                        this.array[index][key] = '';
                    }
                    alert('이미 동일한 출판물이 선택되어 있습니다');
                }
            },
            _delete: function () {
                if( confirm('삭제 하시겠습니까?') ) this.$refs.formDelete.submit()
            },
            _addRow: function () {
                this.array.push({
                    ProductID: '',
                    ProductName: '',
                    ProductKind: '',
                    ProductAlias: '',
                    StockCnt: '',
                    OrderCnt: '',
                });
            },
            _qty: function(index) {
                this.array[index].OrderCnt = this.array[index].OrderCnt.replace(/[^0-9]/g, '')
            },
            _sumQty: function (index) {
                var qty = (this.array[index].OrderCnt * 1) + (this.array[index].StockCnt * 1)
                return !isNaN(qty) ? qty : '';
            },
            _removeRow: function(index) {
                this.array.splice(index, 1)
            },
            _checkExist: function(index){
                for (var key in this.array) {
                    if( key != index )
                    if( this.array[key].ProductID == this.array[index].ProductID ) return this.array[key].ProductID;
                        
                }
                return -1;


            },
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
   
        }
    })
</script>
@endsection
