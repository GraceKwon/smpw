<script type="text/x-template" id="modalPublisherSet">
    <section class="modal-layer-container" ref="modalPublisherSet">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            {{ __('msg.RA') }}
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
                                                v-model="PublisherName"
                                                @keypress.enter="_search"
                                                placeholder="이름 입력">
                                            <button class="btn btn-outline-secondary btn-sm"
                                                @click="_search">
                                                {{ __('msg.SE') }}
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
                                    <th>{{ __('msg.CGN') }}</th>
                                    <th>{{ __('msg.SEAR') }}</th>
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
                                    <td>@{{ Publisher.CongregationName }}</td>
                                    <td>@{{ Publisher.SupportYn ? '{{ __('msg.RAP') }}' : '{{ __('msg.RAI') }}' }}</td>
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

                        <div class="result-area border p-2 mt-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="mr-3">
                                    <span class="text-primary">@{{selectedName}}</span>
                                    <small class="text-muted">@{{selectedCong}}</small>
                                </div>
                                <div class="inline-responsive">
                                    <select class="custom-select custom-select-sm" v-model="LeaderYn">
                                        <option value="0" selected>{{ __('msg.PUB') }}</option>
                                        <option value="1">{{ __('msg.CON') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">{{ __('msg.CLOSE') }}</button>
                        <button class="btn btn-primary btn-sm" @click="_submit()">{{ __('msg.RA') }}</button>
                    </div>
                </div> <!-- /.mlp-wrap -->
            </div>
        </div>
    </section> <!-- /.modal-layer-container -->
</script>
<script>
    Vue.component('modal-publisher-set', {
        template: '#modalPublisherSet',
        props: [
            'CircuitId',
            'ServiceDate',
            'ServiceTimeId',
            'ServiceZoneId',
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
        computed: {
            selectedName: function () {
                var res = this.PublisherList.find(function (el) {
                    return el.PublisherID == this.PublisherID;
                }.bind(this))
                return (typeof res !== 'undefined') ? res.PublisherName : '';
            },
            selectedCong: function () {
                var res = this.PublisherList.find(function (el) {
                    return el.PublisherID == this.PublisherID;
                }.bind(this))
                return (typeof res !== 'undefined') ? res.CongregationName : '';
            }
        },
        methods:{
            _submit: function(){
                if(this.PublisherID === null){
                    alert('{{ __('msg.SEAR_PUB') }}') ;
                    return;
                }
                var formData = {
                    ServiceZoneID: this.ServiceZoneId,
                    ServiceTimeID: this.ServiceTimeId,
                    PublisherID: this.PublisherID,
                    LeaderYn: this.LeaderYn,
                    WaitingYn: 0,
                    ServiceDate: this.ServiceDate,
                }
                axios.post('/modalPublisherSet', formData)
                    .then(function (response) {
                        console.log(response.data);
                        if(response.data === 'full') alert('{{ __('msg.NO_TIME') }}');
                        if(response.data === 'Already Leader') alert('{{ __('msg.ARCONT') }}');
                        location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            _getList: function(){
                var formData = {
                    CircuitID: this.CircuitId,
                    ServiceZoneID: this.ServiceZoneId,
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
