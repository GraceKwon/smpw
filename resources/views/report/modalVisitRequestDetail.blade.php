<script type="text/x-template" id="modalVisitRequestDetail">
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
                                    <th>관심자</th>
                                    <th>성별</th>
                                    <th>주소</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(VisitRequest, index) in VisitRequestList">
                                    <td>@{{ index+1 }}</td>
                                    <td>
                                        <a :href="'/publishers/' + VisitRequest.PublisherID" target="_blank">
                                            @{{ VisitRequest.PublisherName }}
                                        </a>
                                    </td>
                                    <td>
                                        <a :href="'/requests/' + VisitRequest.VisitRequestID" target="_blank">
                                            @{{ VisitRequest.InsteresterName }}
                                        </a>
                                    </td>
                                    <td>@{{ VisitRequest.InsteresterGender }}</td>
                                    <td>@{{ VisitRequest.Sido + ' ' +VisitRequest.Sigungu + ' ' + VisitRequest.AddressMain }}</td>
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
    Vue.component('modal-visit-request-detail', {
        template: '#modalVisitRequestDetail',
        props: [
            'ServiceTimeId',
            'ServiceTime',
            'ZoneName',
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
                axios.post('/modalVisitRequestDetail', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.VisitRequestList = response.data;
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