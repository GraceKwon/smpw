<script type="text/x-template" id="modalPush">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            지원 요청
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            순회구 내의 봉사 지원이 가능한 모든 봉사자에게 지원 요청 메세지가 전달됩니다.
                        </div>
                        <div class="border p-3">
                            요청정보 :
                            <span class="text-primary">@{{ ServiceDate }}  @{{ ZoneName }} @{{ ServiceTime }}</span>
                            구역
                        </div>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">닫기</button>
                        <button class="btn btn-primary btn-sm"
                            @click="_submit">봉사 요청</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section> <!-- /.modal-layer-container -->
</script>

<script>
    Vue.component('modal-push', {
        template: '#modalPush',
        props: [
            'CircuitId',
            'ZoneName',
            'ServiceZoneId',
            'ServiceDate',
            'PushUrl',
            'ServiceTimeId',
            'ServiceTime',
        ],
        methods:{
            _submit: function(){
                var formData = {
                    CircuitID: this.CircuitId,
                    ServiceZoneID: this.ServiceZoneId,
                    ServiceDate: this.ServiceDate,
                    ServiceTimeID: this.ServiceTimeId,
                };
                axios.post('/' + this.PushUrl , formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.$emit('close');

                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },
        }
    })
</script>