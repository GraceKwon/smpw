<section class="modal-layer-container hide" ref="popupCancelPublisher">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        스케줄 삭제
                    </div>
                    <div class="mlp-close" @click="_closePopup('popupCancelPublisher')">
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
                                    <select class="custom-select custom-select-sm">
                                        <option selected="">본인불참</option>
                                        <option>생성오류</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm" @click="_closePopup('popupCancelPublisher')">닫기</button>
                    <button class="btn btn-primary btn-sm">일정 삭제</button>
                </div>
            </div>
        </div> <!-- /.mlp-wrap -->
    </div>
</section> <!-- /.modal-layer-container -->