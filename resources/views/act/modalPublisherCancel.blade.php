<script type="text/x-template" id="modalPublisherCancel">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.DS') }}
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            <div>
                                {{ __('msg.REASON_CANCEL') }}
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
                                            @foreach ($CancelTypeList as $CancelType)
                                            @if ($CancelType->Item === __('msg.PR') ||
                                                    $CancelType->Item === __('msg.SYS_ERROR'))
                                                <option value="{{$CancelType->ID}}">{{$CancelType->Item}}</option>
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
                        <button class="btn btn-primary btn-sm" @click="_submit">{{ __('msg.DS') }}</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section> <!-- /.modal-layer-container -->
</script>

<script>
    Vue.component('modal-publisher-cancel', {
        template: '#modalPublisherCancel',
        props: [
            'ServiceZoneId',
            'ServiceTimeId',
            'PublisherId',
            'ServiceDate',
        ],
        data: function(){
            return {
                CancelTypeID: "{{ getItemID('본인불참', 'CancelTypeID') ?? 0 }}",
            }
        },
        methods:{
            _submit: function(){
                var formData = {
                    ServiceZoneID: this.ServiceZoneId,
                    ServiceTimeID: this.ServiceTimeId,
                    PublisherID: this.PublisherId,
                    CancelTypeID: this.CancelTypeID,
                    ServiceDate: this.ServiceDate,
                }
                axios.post('/modalPublisherCancel', formData)
                    .then(function (response) {
                        console.log(response);
                        location.reload()
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    })
</script>
