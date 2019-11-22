<script type="text/x-template" id="modalInvoiceCode">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            송장 정보 입력 팝업창
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="table-area">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>도시</th>
                                    <th>순회구</th>
                                    <th>담당자</th>
                                    <th>연락처</th>
                                    <th>신청일자</th>
                                    <th>송장번호 입력</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in array">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ $parent.$refs[row].getElementsByClassName('MetroName')[0].innerText }}</td>
                                        <td>@{{ $parent.$refs[row].getElementsByClassName('CircuitName')[0].innerText }}</td>
                                        <td>@{{ $parent.$refs[row].getElementsByClassName('AdminName')[0].innerText }}</td>
                                        <td>@{{ $parent.$refs[row].getElementsByClassName('Mobile')[0].innerText }}</td>
                                        <td>@{{ $parent.$refs[row].getElementsByClassName('CreateDate')[0].innerText }}</td>
                                        <td v-if="index === 0"
                                            :rowspan="array.length">
                                            <input type="text" 
                                                v-model="InvoiceCode"
                                                :class="{ 'is-invalid' : error }"
                                                class="form-control form-control-sm max-w-250px">
                                            <div class="invalid-feedback" v-if="error">송장번호를 입력해주세요.</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm"
                            @click="$emit('close')">닫기</button>
                        <button class="btn btn-primary btn-sm"
                            :disabled="submited"
                            @click="_submit">확인</button>
                    </div>
                </div> <!-- /.mlp-wrap -->
            </div>
        </div>
    </section>  
</script>
<script>
    Vue.component('modal-invoice-code', {
        template: '#modalInvoiceCode',
        props: [
            'array',
        ],
        data: function () {
            return {
                InvoiceCode: '',
                submited: false,
                error: false
            }
        },
        methods:{
            _submit: function () {
                this.InvoiceCode = this.InvoiceCode.replace(/\s/gi, "");
                if(this.InvoiceCode === ''){
                    this.error = true;
                    return;
                } 
                this.submited = true;
                this.$emit('submit', this.InvoiceCode);
            },
        }
    })
</script>