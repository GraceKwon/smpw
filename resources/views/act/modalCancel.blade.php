<script type="text/x-template" id="modalCancel">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            봉사 취소
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                            <div class="mb-1">
                                취소한 타임 스케줄은 복원할 수 없으며,<br/>
                                계확된 모든 봉사자에게 취소 메시지가 전송됩니다.
                            </div>
                            <div>
                                사유를 선택하신 후 신중히 취소를 수행해 주시길 바랍니다.
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
                                                @if($CancelType->Item === '날씨' 
                                                || $CancelType->Item === '인원부족'
                                                || $CancelType->Item === '구역문제'
                                                || $CancelType->Item === '신권활동'
                                                || $CancelType->Item === '기타')
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
                        // location.reload()
                    })
                    .catch(function (error) {
                        console.log(error);
                        console.log(error.response);
                    });
            }
        }
    })
</script>