<script type="text/x-template" id="modalPush">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.RS') }}
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            {{ __('msg.ASM') }}
                        </div>
                        <div class="border p-3">
                            {{ __('msg.RI') }} :
                            <span class="text-primary">@{{ ServiceDate }}  @{{ ZoneName }} @{{ ServiceTime }}</span>
                            {{ __('msg.ZONE') }}
                        </div>
                        </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">닫기</button>
                    <button class="btn btn-primary btn-sm"
                        @click="_submit">{{ __('msg.SR') }}</button>
                </div>
            </div>
        </div> <!-- /.mlp-wrap -->
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
