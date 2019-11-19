<script type="text/x-template" id="modalProductDetail">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            보고된 출판물 목록
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
                                    <th>도시</th>
                                    <td>{{ getMetroName() }}</td>
                                    <th>지역</th>
                                    <td>{{ getCircuitName() }}</td>
                                </tr>
                                <tr>
                                    <th>구역</th>
                                    <td>@{{ ZoneName }}</td>
                                    <th>시간대</th>
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
                                    <th>보고자</th>
                                    <th>언어</th>
                                    <th>출판물분류</th>
                                    <th>출판물이름</th>
                                    <th>수량</th>
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
                            @click="$emit('close')">닫기</button>
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