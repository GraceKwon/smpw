@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <form method="POST"
        @submit="_confirm" 
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
            <tbody v-for="(row, index) in array">
                <tr>
                    <th>
                        <label class="label">출판물선택</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <select class="custom-select" 
                                name="ProductID[]"
                                v-model="row.ProductID" 
                                @change="_getProductStock(index)"
                                >
                                <option value="">선택</option>
                                @foreach ($ProductList as $Product)
                                    <option 
                                        value="{{ $Product->ProductID }}">{{ $Product->ProductName }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary"
                                type="button"
                                @click="_removeRow(index)">삭제</button>
                        </div>
                    </td>
                    <th>
                        <label class="label">현재재고량</label>
                    </th>
                    <td v-html="row.StockCnt">
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
                    <td v-html="_sumQty(index)">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-2">
            <button class="btn btn-outline-secondary"
                type="button"
                @click="_addRow">+ 출판물 추가</button>
        </div>
        <div class="btn-flex-area justify-content-end">
            <button type="button" class="btn btn-secondary">취소</button>
            <button type="submit" class="btn btn-primary">저장</button>
        </div> <!-- /.register-btn-area -->
    </form>
</section>
@endsection
@section('popup')
    <modal-order-comfirm v-if="showModal === 'modalOrderConfirm'" 
        :array="array"
        @close="showModal = ''" >
    </modal-order-confirm>
@endsection
@section('script')
@include('product.modalOrderConfirm')
<script>
    var app = new Vue({
        el: '#wrapper-body',
        data: {
            showModal: '',
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
                e.preventDefault();
                // var res = confirm('{{ isset($Experience->ExperienceID) ? '수정 ' : '저장 ' }} 하시겠습니까?');
                // if (!res) {
                // }
            },
            _getProductStock: function(index){
                console.log(this._checkExist(index));  
                if( this._checkExist(index) < 0){
                    
                    var formData = {
                        ProductID: this.array[index].ProductID,
                    };
                    axios.post('/api/getProductStock', formData)
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
            // _showModal: function(modalName) {
            //     this.showModal = modalName;
            // },
            // _selected: function(data) {
            //     console.log(data);
            //     for (var key in data) {
            //         this.$data[key] = data[key];
            //     }
            // },
            // _export:function () {
            //     location.href = '/{{ request()->path() }}/export';
            // },
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
                    console.log('key', this.array[key].ProductID);
                    console.log('index', this.array[index].ProductID);
                    if( key != index )
                    if( this.array[key].ProductID == this.array[index].ProductID ) return this.array[key].ProductID;
                        
                }
                return -1;


            },
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
            // _setCircuitConfirm: function () {
            //     if( confirm('제출 하시겠습니까?') ) this.$refs.formCircuitConfirm.submit()
            // },
            // _setBranchConfirm: function () {
            //     if( confirm('열람내용확인 하시겠습니까?') ) this.$refs.formBranchConfirm.submit()
            // }

        }
    })
</script>
@endsection
