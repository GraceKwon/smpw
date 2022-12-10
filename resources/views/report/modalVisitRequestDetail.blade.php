<script type="text/x-template" id="modalVisitRequestDetail">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.LIST_VISIT_REQUEST') }}
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
                                    <th>{{ __('msg.INTEREST_ONE') }}</th>
                                    <th>{{ __('msg.GENDER') }}</th>
                                    <th>{{ __('msg.ADDR') }}</th>
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
                            @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
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
