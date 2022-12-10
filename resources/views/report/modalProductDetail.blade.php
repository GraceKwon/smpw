<script type="text/x-template" id="modalProductDetail">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.LIST_PUB_REPORT') }}
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
                                    <th>{{ __('msg.CITY') }}</th>
                                    <td>{{ getMetroName() }}</td>
                                    <th>{{ __('msg.A') }}</th>
                                    <td>{{ getCircuitName() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('msg.ZONE') }}</th>
                                    <td>@{{ ZoneName }}</td>
                                    <th>{{ __('msg.SLOT') }}</th>
                                    <td>@{{ ServiceTime }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-area mt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>{{ __('msg.REPORTER') }}</th>
                                    <th>{{ __('msg.LANG') }}</th>
                                    <th>{{ __('msg.PC') }}</th>
                                    <th>{{ __('msg.PUB_NAME') }}</th>
                                    <th>{{ __('msg.Q') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(Product, index) in ProductList">
                                    <td>@{{ index+1 }}</td>
                                    <td>
                                        <a :href="'/publishers/' + Product.PublisherID" target="_blank">
                                            @{{ Product.PublisherName }}
                                        </a>
                                    </td>
                                    <td>@{{ Product.LanguageName }}</td>
                                    <td>@{{ Product.ProductType }}</td>
                                    <td>@{{ Product.ProductName }}</td>
                                    <td>@{{ Product.Qty }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm"
                            @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section>
</script>
<script>
    Vue.component('modal-product-detail', {
        template: '#modalProductDetail',
        props: [
            'ServiceTimeId',
            'ServiceTime',
            'ZoneName',
        ],
        data: function () {
            return {
                ServiceDate: "{{ request()->ServiceDate }}",
                ProductList: []
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
                axios.post('/modalProductDetail', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.ProductList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            // _submit: function(){
            //     var formData = {
            //         CircuitID: this.CircuitId,
            //         ServiceZoneID: this.ServiceZoneId,
            //         ServiceTimeID: this.ServiceTimeId,
            //         CancelTypeID: this.CancelTypeID,
            //         ServiceDate: this.ServiceDate,
            //     }
            //     axios.post('/' + this.url, formData)
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
