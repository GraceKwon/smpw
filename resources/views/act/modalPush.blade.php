<script type="text/x-template" id="modalPush">
    <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-auto">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            지원 요청 (미구현)
                        </div>
                        <div class="mlp-close" @click="$emit('close')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content text-center">
                        <div class="text-danger font-size-90 mb-3">
                                순회구 내의 봉사 지원이 가능한 모든 봉사자에게 지원 요청 메세지가 전달됩니다.
                        </div>
                        <div class="border p-3">
                            요청정보 :
                            {{-- <span class="text-primary">11월 4일 / 10시 - 강남역 10번출구</span> --}}
                            구역
                        </div>
                        </div>
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" @click="$emit('close')">닫기</button>
                        <button class="btn btn-primary btn-sm">봉사 요청</button>
                    </div>
                </div>
            </div> <!-- /.mlp-wrap -->
        </div>
    </section> <!-- /.modal-layer-container -->
</script>

<script>
    Vue.component('modal-push', {
        template: '#modalPush',
        // props: [
        //     'CircuitId',
        //     'ServiceDate',
        //     'ServiceTimeId',
        //     'ServiceZoneId',
        // ],
        // data: function(){
        //     return {
        //         PublisherName: '',
        //         PublisherList: [],
        //         PublisherID: null,
        //         LeaderYn: '0',
        //         page: 1,
        //         lastPage: null,
        //     }
        // },
        // computed: {
        //     selectedName: function () {
        //         var res = this.PublisherList.find(function (el) {
        //             return el.PublisherID == this.PublisherID;
        //         }.bind(this))
        //         return (typeof res !== 'undefined') ? res.PublisherName : '';
        //     },
        //     selectedCong: function () {
        //         var res = this.PublisherList.find(function (el) {
        //             return el.PublisherID == this.PublisherID;
        //         }.bind(this))
        //         return (typeof res !== 'undefined') ? res.CongregationName : '';
        //     }
        // },
        // methods:{
        //     _submit: function(){
        //         if(this.PublisherID === null){
        //             alert('봉사자를 조회하여 선택해주세요.') ;
        //             return;
        //         } 
        //         var formData = {
        //             ServiceZoneID: this.ServiceZoneId,
        //             ServiceTimeID: this.ServiceTimeId,
        //             PublisherID: this.PublisherID,
        //             LeaderYn: this.LeaderYn,
        //             WaitingYn: 0,
        //             ServiceDate: this.ServiceDate,
        //         }
        //         axios.post('/api/modalPublisherSet', formData)
        //             .then(function (response) {
        //                 console.log(response.data);
        //                 if(response.data === 'full') alert('해당 타임에 빈자리가 없습니다.');
        //                 if(response.data === 'Already Leader') alert('이미 인도자가 있습니다.');
        //                 location.reload();
        //             })
        //             .catch(function (error) {
        //                 console.log(error);
        //             });
        //     },
        //     _getList: function(){
        //         var formData = {
        //             CircuitID: this.CircuitId,
        //             ServiceZoneID: this.ServiceZoneId,
        //             PublisherName: this.PublisherName,
        //             page: this.page,
        //         };
        //         axios.post('/api/modalPublisherSet/search', formData)
        //             .then(function (response) {
        //                 console.log(response.data);
        //                 this.PublisherList = response.data.data;
        //                 this.lastPage = response.data.lastPage;
        //             }.bind(this))
        //             .catch(function (error) {
        //                 console.log(error);
        //             });
        //     },
        //     _search: function(){
        //         this.page = 1
        //         this._getList()
        //     },
        //     _prevPage: function(){
        //         if(this.page > 1){
        //             this.page --;
        //             this._getList()
        //         } 
        //     },
        //     _nextPage: function(){
        //         if(this.page < this.lastPage){
        //             this.page ++;
        //             this._getList()
        //         } 
        //     },
        // }
    })
</script>