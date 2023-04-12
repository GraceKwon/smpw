<script type="text/x-template" id="modalCancel">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.CANCEL_SERVICE') }}
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            <div class="mb-1">
                                {{ __('msg.AC1') }}<br/>
                                {{ __('msg.AC2') }}
                            </div>
                            <div>
                                {{ __('msg.AC3') }}
                            </div>
                        </div>
                        <div class="table-area">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>{{ __('msg.CR') }}</th>
                                    <td>
                                        <select class="custom-select custom-select-sm"
                                            v-model="CancelTypeID">
                                            <!-- TODO 취소사유.. DB에서 한글로 내려주는 듯 -->
                                            @foreach ($CancelTypeList as $CancelType)
                                                @if($CancelType->Item === 'WEATHER'
                                                || $CancelType->Item === 'UNDERSTAFFED'
                                                || $CancelType->Item === 'ZONE PROBLEMS'
                                                || $CancelType->Item === '신권활동'
                                                || $CancelType->Item === 'ETC')
                                                    <option value="{{$CancelType->ID}}">
                                                        {{ $locale==='ko'?$CancelType->ItemKOR:$CancelType->ItemEng }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
                        <button class="btn btn-primary btn-sm" @click="_submit">{{ __('msg.CANCEL_SERVICE') }}</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section> <!-- /.modal-layer-container -->
</script>

<script>
    Vue.component('modal-cancel', {
        template: '#modalCancel',
        props: [
            'ServiceZoneId',
            'ServiceTimeId',
            'ServiceDate',
            'CancelRange',
            'CircuitId',
        ],
        data: function(){
            return {
                CancelTypeID: "{{ getItemID('날씨', 'CancelTypeID') ?? 0 }}",
            }
        },
        computed: {
            url: function () {
                if(this.CancelRange === 'time')
                    return 'modalTimeCancel';
                if(this.CancelRange === 'zone')
                    return 'modalZoneCancel';
                if(this.CancelRange === 'today')
                    return 'modalDayCancel';
            },
        },
        methods:{
            _submit: function(){
                var formData = {
                    CircuitID: this.CircuitId,
                    ServiceZoneID: this.ServiceZoneId,
                    ServiceTimeID: this.ServiceTimeId,
                    CancelTypeID: this.CancelTypeID,
                    ServiceDate: this.ServiceDate,
                }
                axios.post('/' + this.url, formData)
                    .then(function (response) {
                        console.log(response.data);
                        location.reload()
                    })
                    .catch(function (error) {
                        console.log(error);
                        console.log(error.response);
                    });
            }
        }
    })
</script>
