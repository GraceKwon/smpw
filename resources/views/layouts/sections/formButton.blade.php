<div class="btn-flex-area justify-content-end">
    <button type="button" class="btn btn-secondary" 
        onclick="location.href = '/{{ getTopPath() }}'">취소</button>
    @if(session('auth.CircuitID'))
        @if($id)
            <button type="button" class="btn btn-point-sub"
                @click="_delete">삭제</button>
        @endif
            <button type="submit" class="btn btn-primary">
                {{ $id ? '수정' : '저장' }}</button>
    @endif
</div>