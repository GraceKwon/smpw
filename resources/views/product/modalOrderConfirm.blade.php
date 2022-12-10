<script type="text/x-template" id="modalOrderConfirm">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.PUB_REQUEST_LIST') }}
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
                            </table>
                        </div>
                        <div class="table-area mt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('msg.C') }}</th>
                                    <th>{{ __('msg.CODE') }}</th>
                                    <th>{{ __('msg.PUB_NAME') }}</th>
                                    <th>{{ __('msg.CS') }}</th>
                                    <th>{{ __('msg.AQ') }}</th>
                                    <th>{{ __('msg.SAR') }}</th>
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
                            @click="$emit('close')">{{ __('msg.EDIT') }}</button>
                        <button class="btn btn-primary btn-sm"
                            @click="$emit('submit')">{{ __('msg.CONFIRM') }}</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section>
</script>
<script>
    Vue.component('modal-order-confirm', {
        template: '#modalOrderConfirm',
        props: [
            'array',
        ],
        // data: function () {
        //     return {
        // },
        methods:{
            _sumQty: function (index) {
                var qty = (this.array[index].OrderCnt * 1) + (this.array[index].StockCnt * 1)
                return !isNaN(qty) ? qty : '';
            },
        }
    })
</script>
