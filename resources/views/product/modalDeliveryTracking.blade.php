<script type="text/x-template" id="modalDeliveryTracking">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            배송 조회
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center min-w-500px-desktop">
                        <div class="table-area">
                            <table class="table table-bordered">
                                </thead>
                                <tbody>
                                <tr>
                                    <th>송장번호</th>
                                    <td colspan="2">
                                        @{{ tracks }}
                                    </td>
                                </tr>
                                <tr v-for="progresses in trackingInfo">
                                    <th>
                                        @{{ progresses.location.name }}
                                    </th>
                                    <th>
                                        @{{ progresses.time }} 
                                    </th>
                                    <td>
                                        @{{ progresses.description }}
                                    </td>
                                </tr>
                                <tr v-if="error">
                                    <td colspan="3">
                                        @{{ error }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm"
                            @click="$emit('close')">닫기</button>
                        {{-- <button class="btn btn-primary btn-sm">확인</button> --}}
                    </div>
                </div> <!-- /.mlp-wrap -->
            </div>
        </div>
    </section>
</script>
<script>
    Vue.component('modal-delivery-tracking', {
        template: '#modalDeliveryTracking',
        props: [
            'tracks',
        ],
        data: function () {
            return {
                carriers: 'kr.cjlogistics',
                trackingInfo: [],
                error: ''
            }
        },
        mounted: function() {
            this._tracking();
        },
        methods:{
            _tracking: function () {
                axios.get('https://apis.tracker.delivery/carriers/'+ this.carriers +'/tracks/' + this.tracks)
                    .then(function (response) {
                        console.log(response.data);
                        this.trackingInfo = response.data.progresses;
                    }.bind(this))
                    .catch(function (error) {
                        this.error = '요청실패';
                        console.log(error.response)
                    }.bind(this));
            },
        }
    })
</script>