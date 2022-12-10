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
                    <label class="label">{{ __('msg.CITY') }}</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->MetroName ?? getMetroName() }}</div>
                </td>
                <th>
                    <label class="label">{{ __('msg.A') }}</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->CircuitName ?? getCircuitName() }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">{{ __('msg.AN') }}</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->AdminName ?? session('auth.AdminName')}}</div>
                </td>
                <th>
                    <label class="label">{{ __('msg.TEL') }}</label>
                </th>
                <td>
                    <div>{{ $ProductOrder->Mobile ?? getMobile() }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">{{ __('msg.AD') }}</label>
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
                        <label class="label">{{ __('msg.PUB_SELECT') }}</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <select class="custom-select"
                                name="ProductID[]"
                                v-model="row.ProductID"
                                :disabled="!modify"
                                @change="_getProductStock(index)"
                                >
                                <option value="">{{ __('msg.SELECT') }}</option>
                                @foreach ($ProductList as $Product)
                                    <option
                                        value="{{ $Product->ProductID }}">{{ $Product->ProductName }}</option>
                                @endforeach
                            </select>
                            @if(empty($ProductOrder->ProductOrderID))
                            <button class="btn btn-outline-secondary"
                                type="button"
                                @click="_removeRow(index)">{{ __('msg.DEL') }}</button>
                            @endif
                        </div>
                    </td>
                    <th>
                        <label class="label">{{ __('msg.CS') }}</label>
                    </th>
                    <td
                    @if( empty($ProductOrder->InvoiceCode) )
                        v-html="row.StockCnt"
                    @endif>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.C') }}</label>
                    </th>
                    <td v-html="row.ProductKind"></td>
                    <th>
                        <label class="label">{{ __('msg.AQ') }}</label>
                    </th>
                    <td>
                        <div class="d-flex max-w-300px-desktop">
                            <input type="text"
                                name="OrderCnt[]"
                                v-model="row.OrderCnt"
                                :disabled="!modify"
                                @keyup="_qty(index)"
                                class="form-control"
                                placeholder="{{ __('msg.ENTER_QUANTITY') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.CODE') }}</label>
                    </th>
                    <td v-html="row.ProductAlias"></td>
                    <th>
                        <label class="label">{{ __('msg.SAR') }}</label>
                    </th>
                    <td
                    @if( empty($ProductOrder->InvoiceCode) )
                        v-html="_sumQty(index)"
                    @endif>
                    </td>
                </tr>
            </tbody>
            <tbody @if( session('auth.AdminRoleID') !== 2) class="off" @endif>
                @if(isset($ProductOrder->ProductOrderID))
                <tr v-if="!modify">
                    <th>
                        <label class="label">{{ __('msg.IN_VOICE_NUN') }}</label>
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
                                    placeholder="{{ __('msg.ENTER_INV_NUM') }}"
                                @endif
                                >
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        @if(empty($ProductOrder->ProductOrderID))
        <div class="text-center mt-2">
            <button class="btn btn-outline-secondary"
                type="button"
                @click="_addRow">+ {{ __('msg.AP') }}</button>
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
                    @click="modify = true">{{ __('msg.EDIT') }}</button>
                <button class="btn btn-outline-secondary"
                    type="button"
                    v-if="modify"
                    @click="this.location.reload()">{{ __('msg.CANCEL') }}</button>
                @endif
            </div>
            <div class="d-flex">
                <button type="button" class="btn btn-secondary"
                    onclick="location.href='/{{ getTopPath() }}'">
                    {{ isset($ProductOrder->ProductOrderID) ? __('msg.LIST') : __('msg.CANCEL') }}
                </button>
                <button type="button"
                    class="btn btn-primary"
                    v-if="modify"
                    @click="_confirm">{{ __('msg.SAVE') }}</button>
                @if(isset($ProductOrder->ProductOrderID)
                    && empty($ProductOrder->InvoiceCode)
                    && session('auth.AdminRoleID') !== 2)
                    <button type="button" class="btn btn-point-sub"
                        v-if="!modify"
                        @click="_delete">{{ __('msg.DEL') }}</button>
                @elseif(session('auth.AdminRoleID') === 2)
                    <button type="submit" class="btn btn-point-sub">{{ __('msg.SAVE') }}</button>
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
    <modal-order-confirm v-if="showModal === 'modalOrderConfirm'"
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
                    alert('{{ __('msg.SAME_PUB') }}');
                }
            },
            _delete: function () {
                if( confirm('{{ __('msg.WISH_DELETE') }}') ) this.$refs.formDelete.submit()
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
