<script type="text/x-template" id="modalOrderConfirm">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            방문요청 목록
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="table-area">
                            <table class="table table-bordered">
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
                            </table>
                        </div>
                        <div class="table-area mt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>분류</th>
                                    <th>약호</th>
                                    <th>출판물명</th>
                                    <th>현재재고량</th>
                                    <th>신청수량</th>
                                    <th>수령 후 재고량</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(row, index) in array">
                                    <td>
                                        @{{ row.ProductKind }}
                                    </td>
                                    <td>
                                        @{{ row.ProductAlias }}
                                    </td>
                                    <td>@{{ row.ProductName }}</td>
                                    <td>@{{ row.StockCnt }}</td>
                                    <td>@{{ row.OrderCnt }}</td>
                                    <td>@{{ _sumQty(index) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" 
                            @click="$emit('close')">닫기</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section>
</script>
<script>
    Vue.component('modal-order-comfirm', {
        template: '#modalOrderConfirm',
        props: [
            'array',
            // 'ServiceTime',
            // 'ZoneName',
        ],
        data: function () {
            return {
                ServiceDate: "{{ request()->ServiceDate }}",
                VisitRequestList: []
            }
        },
        mounted: function() {
            this._getList();
        },
        methods:{
            _getList: function(){
                var formData = {
                    ServiceTimeID: this.ServiceTimeId,
                    ServiceDate: this.ServiceDate,
                };
                axios.post('/api/modalVisitRequestDetail', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.VisitRequestList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            _sumQty: function (index) {
                var qty = (this.array[index].OrderCnt * 1) + (this.array[index].StockCnt * 1)
                return !isNaN(qty) ? qty : '';
            },
            // _submit: function(){
            //     var formData = {
            //         CircuitID: this.CircuitId,
            //         ServiceZoneID: this.ServiceZoneId,
            //         ServiceTimeID: this.ServiceTimeId,
            //         CancelTypeID: this.CancelTypeID,
            //         ServiceDate: this.ServiceDate,
            //     }
            //     axios.post('/api/' + this.url, formData)
            //         .then(function (response) {
            //             console.log(response);
            //             location.reload()
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //             console.log(error.response);
            //         });
            // }
        }
    })
</script>