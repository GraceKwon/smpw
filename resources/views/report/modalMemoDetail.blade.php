<script type="text/x-template" id="modalMemoDetail">
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
                                    <th>봉사일시</th>
                                    <td>@{{ ServiceDate + ' ' +ServiceTime }}</td>
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
                                    <th>전달사항</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(Memo, index) in MemoList">
                                    <td>@{{ index+1 }}</td>
                                    <td>
                                        <a :href="'/publishers/' + Memo.PublisherID" target="_blank">
                                            @{{ Memo.PublisherName }}
                                        </a>
                                    </td>
                                    <td>@{{ Memo.Memo }}</td>
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
    Vue.component('modal-memo-detail', {
        template: '#modalMemoDetail',
        props: [
            'ServiceTimeId',
            'ServiceTime',
            'ZoneName',
        ],
        data: function () {
            return {
                ServiceDate: "{{ request()->ServiceDate }}",
                MemoList: []
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
                axios.post('/modalMemoDetail', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.MemoList = response.data;
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