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
                            <!--<tr>
                                <td colspan="4">
                                    <div class="text-muted text-center">
                                        검색 결과가 없습니다.
                                    </div>
                                </td> 
                            </tr>-->
                            <tr >
                                <td>1</td>
                                <td>김사랑</td>
                                <td>남양주</td>
                                <td>임의배정 가능</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>김사랑</td>
                                <td>남양주</td>
                                <td>임의배정 가능</td>
                            </tr> 
                            </tbody>
                        </table>
                    </div>
                    <div class="result-area border p-2 mt-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="mr-3">
                                <span class="text-primary">김사랑</span>
                                <small class="text-muted">(남양주)</small>
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
