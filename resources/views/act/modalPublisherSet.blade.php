<script type="text/x-template" id="modalPublisherSet">
<section class="modal-layer-container" ref="modalPublisherSet">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        임의 배정
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
                                <th>봉사자 조회</th>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <input class="form-control form-control-sm mr-1" 
                                            v-model="PublisherName"
                                            @keypress.enter="_search"
                                            placeholder="이름 입력">
                                        <button class="btn btn-outline-secondary btn-sm"
                                            @click="_search">
                                            검색
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
                                <th>성명</th>
                                <th>회중</th>
                                <th>조회결과</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!PublisherList.length">
                                <td colspan="4">
                                    <div class="text-muted text-center">
                                        검색 결과가 없습니다.
                                    </div>
                                </td> 
                            </tr>
                            <tr v-for="Publisher in PublisherList" >
                                <td>@{{ Publisher.PublisherID }}</td>
                                <td class="pointer" @click="PublisherID = Publisher.PublisherID">@{{ Publisher.PublisherName }}</td>
                                <td>@{{ Publisher.CongregationName }}</td>
                                <td>@{{ Publisher.SupportYn ? '임의배정가능' : '임의배정불가' }}</td>
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
                                    <option value="0" selected>봉사자</option>
                                    <option value="1">인도자</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">닫기</button>
                    <button class="btn btn-primary btn-sm" @click="_submit()">임의 배정</button>
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
                lastPage: null
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
                    alert('봉사자를 조회하여 선택해주세요.') ;
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
                axios.put('/api/modalPublisherSet', formData)
                    .then(function (response) {
                        console.log(response);
                        location.reload()
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            _getList: function(){
                var formData = {
                    ServiceZoneID: this.ServiceZoneId,
                    PublisherName: this.PublisherName,
                    page: this.page,
                };
                axios.put('/api/modalPublisherSet/search', formData)
                    .then(function (response) {
                        console.log(response.data);
                        this.PublisherList = response.data.data;
                        this.lastPage = response.data.lastPage;
                        // console.log(this.PublisherList);
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