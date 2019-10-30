<section class="modal-layer-container hide" ref="popupCancel">
    <div class="mx-auto px-3">
        <div class="mlp-wrap">
            <div class="max-w-auto">
                <div class="mlp-header">
                    <div class="mlp-title">
                        봉사 취소
                    </div>
                    <div class="mlp-close" @click="_closePopup('popupCancel')">
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
                                    <select class="custom-select custom-select-sm">
                                        <option selected="">날씨</option>
                                        <option>인원부족</option>
                                        <option>구역문제</option>
                                        <option>신권활동</option>
                                        <option>기타</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mlp-footer justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm" @click="_closePopup('popupCancel')">닫기</button>
                    <button class="btn btn-primary btn-sm">봉사 취소</button>
                </div>
            </div>
        </div> <!-- /.mlp-wrap -->
    </div>
</section> <!-- /.modal-layer-container -->