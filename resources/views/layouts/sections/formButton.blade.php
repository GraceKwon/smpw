<div class="btn-flex-area justify-content-end">
    <button type="button" class="btn btn-secondary"
        onclick="location.href = '/{{ getTopPath() }}'">{{ __('msg.CANCEL') }}</button>
    {{-- @if(session('auth.CircuitID')) --}}
        @if($id)
            <button type="button" class="btn btn-point-sub"
                @click="_delete">{{ __('msg.DEL') }}</button>
        @endif
            <button type="submit" class="btn btn-primary">
                {{ $id ? __('msg.EDIT') : __('msg.SAVE') }}</button>
    {{-- @endif --}}
</div>
