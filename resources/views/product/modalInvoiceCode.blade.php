<script type="text/x-template" id="modalInvoiceCode">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.INVOICE_POPUP') }}
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
                                    <th>{{ __('msg.CITY') }}</th>
                                    <th>{{ __('msg.AREA') }}</th>
                                    <th>{{ __('msg.NAME_PERSON') }}</th>
                                    <th>{{ __('msg.TEL') }}</th>
                                    <th>{{ __('msg.AD') }}</th>
                                    <th>{{ __('msg.ENTER_IN_NUM') }}</th>
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
                                            <div class="invalid-feedback" v-if="error">{{ __('msg.ENTER_INV_NUM') }}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm"
                            @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
                        <button class="btn btn-primary btn-sm"
                            :disabled="submited"
                            @click="_submit">{{ __('msg.CONFIRM') }}</button>
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
