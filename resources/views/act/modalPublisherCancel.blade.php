<script type="text/x-template" id="modalPublisherCancel">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            스케줄 삭제
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            <div>
                                해당 봉사자의 스케줄 취소 사유를 선택해 주십시오.
                            </div>
                        </div>
                        <div class="table-area">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>취소 사유</th>
                                    <td>
                                        <select class="custom-select custom-select-sm"
                                            v-model="CancelTypeID">
                                            @foreach ($CancelTypeList as $CancelType)
                                            @if($CancelType->Item === '본인불참' || $CancelType->Item === '생성오류')
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
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">닫기</button>
                        <button class="btn btn-primary btn-sm" @click="_submit">일정 삭제</button>
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
                        // location.reload()
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    })
</script>