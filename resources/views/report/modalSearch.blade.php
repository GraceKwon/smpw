<script type="text/x-template" id="modalSearch">
    <section class="modal-layer-container" ref="modalSearch">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.PUBS') }}
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="table-area mb-3">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>{{ __('msg.PUBS') }}</th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <input class="form-control form-control-sm mr-1"
                                                ref="PublisherName"
                                                v-model="PublisherName"
                                                @keypress.enter="_search"
                                                placeholder="{{ __('msg.ENTER_INPUT_NAME') }}">
                                            <button class="btn btn-outline-secondary btn-sm"
                                                @click="_search">
                                                {{ __('msg.SEARCH') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-area">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('msg.NAME') }}</th>
                                    <th>{{ __('msg.GENDER') }}</th>
                                    <th>{{ __('msg.CGN') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="!PublisherList.length">
                                    <td colspan="4">
                                        <div class="text-muted text-center">
                                            {{ __('msg.NO_RESULT') }}
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="Publisher in PublisherList" >
                                    <td>@{{ Publisher.PublisherID }}</td>
                                    <td class="pointer" @click="PublisherID = Publisher.PublisherID">@{{ Publisher.PublisherName }}</td>
                                    <td>@{{ Publisher.Gender === 'M' ? '형제' : '자매' }}</td>
                                    <td>@{{ Publisher.CongregationName }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <span class="pointer">
                                <i class="fas fa-angle-left" @click="_prevPage"></i>
                            </span>
                            <span class="pointer">
                                <i class="fas fa-angle-right" @click="_nextPage"></i>
                            </span>
                        </div>

                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
                    </div>
                </div> <!-- /.mlp-wrap -->
            </div>
        </div>
    </section> <!-- /.modal-layer-container -->
</script>
<script>
    Vue.component('modal-search', {
        template: '#modalSearch',
        props: [
            'CircuitId',
        ],
        data: function(){
            return {
                PublisherName: '',
                PublisherList: [],
                PublisherID: null,
                LeaderYn: '0',
                page: 1,
                lastPage: null,
            }
        },
        mounted: function() {
            this.$refs.PublisherName.focus();
        },
        watch: {
            PublisherID: function(){
                this.$emit('selected', {
                    PublisherID: this.Publisher.PublisherID,
                    PublisherName: this.Publisher.PublisherName,
                    PublisherMobile: this.Publisher.Mobile,
                    CongregationName: this.Publisher.CongregationName,
                    PublisherGender: this.Publisher.Gender === 'M'? '형제' : '자매',
                });
                this.$emit('close');
            }
        },
        computed: {
            Publisher: function () {
                var res = this.PublisherList.find(function (el) {
                    return el.PublisherID == this.PublisherID;
                }.bind(this))
                return (typeof res !== 'undefined') ? res : '';
            },
        },
        methods:{
            _getList: function(){
                var formData = {
                    CircuitID: this.CircuitId,
                    PublisherName: this.PublisherName,
                    page: this.page,
                };
                axios.post('/modalPublisherSet/search', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.PublisherList = response.data.data;
                        this.lastPage = response.data.lastPage;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            _search: function(){
                this.page = 1
                this._getList()
            },
            _prevPage: function(){
                if(this.page > 1){
                    this.page --;
                    this._getList()
                }
            },
            _nextPage: function(){
                if(this.page < this.lastPage){
                    this.page ++;
                    this._getList()
                }
            },
        }
    })
</script>
