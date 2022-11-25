@extends('layouts.frames.master')
@section('content')
<section class="section-wrap schedule-reset">
    <div class="notice">
        <div>{{ __('msg.SCH_DEL_REC') }}</div>
        <div>{{ __('msg.PW') }}</div>
    </div>
    <form method="POST"
    @submit="_confirm"
    @keydown.enter.prevent>
    @method("PUT")
    @csrf
        <div class="item-wrap">
            <label class="label">{{ __('msg.SCH_RESET_DATE') }}</label>
            <div class="input-group max-w-250px-desktop">
                <input type="date"
                    class="form-control @error('ReSetStartDate') is-invalid @enderror"
                    name="ReSetStartDate"
                    placeholder={{ __('msg.PSTD') }}>
                @error('ReSetStartDate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                {{-- <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div> --}}
            </div>
            <div class="btn-area">
                <button class="btn btn-primary">{{ __('msg.SCH_RESET_DATE') }}</button>
            </div>
        </div>
    </form>
</section>
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        methods:{
            _confirm: function (e) {
                let res = confirm('{{ __('msg.SCH_DEL_REC_Q') }}');
                if(!res) {
                    e.preventDefault();
                }
            },
        }
    })

</script>
@endsection
