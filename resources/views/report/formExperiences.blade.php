@extends('layouts.frames.master') @section('content')
<section class="register-section">
    @error('fail')
    <div class="alert alert-danger">{!! $message !!}</div>
    @enderror @if(session('success'))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
    @endif @error('PublisherID')
    <div class="alert alert-danger">{{ __('msg.SELECT_VOL') }}</div>
    @enderror
    <form method="POST" @submit="_confirm" @keydown.enter.prevent>
        @method("PUT") @csrf
        <table class="table table-register">
            <tbody>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.WN') }}</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->AdminName ?? session('auth.AdminName') }}
                        </div>
                    </td>
                    <th>
                        <label class="label">{{ __('msg.TEL') }}</label>
                    </th>
                    <td>
                        <div>{{ $Experience->AdminMobile ?? getMobile() }}</div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.CITY') }}</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->MetroName ?? getMetroName() }}
                        </div>
                    </td>
                    <th>
                        <label class="label">{{ __('msg.A') }}</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->CircuitName ?? getCircuitName() }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.DATE_OF_PRE') }}</label>
                    </th>
                    <td colspan="3">
                        <div>
                            {{ $Experience->CreateDate ?? date('Y-m-d') }}
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody :class="{ off : !modify }">
                <tr>
                    <th>
                        <label class="label">{{ __('msg.PLISH_NAME') }}</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input
                                type="text"
                                class="form-control"
                                :disabled="!modify"
                                name="PublisherName"
                                @click="_showModal('modalSearch')"
                                v-model="PublisherName"
                            />
                            <button
                                type="button"
                                class="btn btn-secondary"
                                :disabled="!modify"
                                @click="_showModal('modalSearch')"
                            >
                                {{ __('msg.PUBS') }}
                            </button>
                        </div>
                        <input
                            type="hidden"
                            name="PublisherID"
                            v-model="PublisherID"
                        />
                    </td>
                    <th>
                        <label class="label">{{ __('msg.GENDER') }}</label>
                    </th>
                    <td>
                        <div class="inline-responsive off">
                            <input
                                type="text"
                                class="form-control"
                                name="PublisherGender"
                                v-model="PublisherGender"
                                readonly
                            />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.CGN') }}</label>
                    </th>
                    <td>
                        <div class="inline-responsive off">
                            <input
                                type="text"
                                class="form-control"
                                name="CongregationName"
                                v-model="CongregationName"
                                readonly
                            />
                        </div>
                    </td>
                    <th>
                        <label class="label">{{ __('msg.TEL') }}</label>
                    </th>
                    <td colspan="3">
                        <div class="inline-responsive off">
                            <input
                                type="text"
                                class="form-control"
                                name="PublisherMobile"
                                v-model="PublisherMobile"
                                readonly
                            />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.EX') }}</label>
                    </th>
                    <td colspan="3">
                        <textarea
                            type="text"
                            class="form-control w-100 @error('Contents') is-invalid @enderror"
                            name="Contents"
                            v-model="Contents"
                            :disabled="!modify"
                            rows="5"
                            placeholder="{{ __('msg.ENTER_EX') }}"
                        >
                        </textarea>
                        @error('Contents')
                        <div class="invalid-feedback">
                            {{ __('msg.ENTER_EX') }}
                        </div>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
            <div class="d-flex">
                @if( isset($Experience->ExperienceID) )
                <button type="button"
                    class="btn btn-success"
                    v-if="!modify"
                    @click="_export">
                    {{ __('msg.EXCEL_DOWN') }}
                </button>
                @endif
            </div>
            <div class="d-flex">
            @if( isset($Experience->ExperienceID) )
                <button type="button"
                    class="btn btn-outline-secondary"
                    v-if="!modify"
                    onclick="location.href='/{{ getTopPath() }}'">{{ __('msg.LIST') }}</button>
                <button type="button"
                    class="btn btn-secondary"
                    v-if="!modify"
                    @click="modify = true">{{ __('msg.EDIT') }}</button>
                <button class="btn btn-outline-secondary"
                    type="button"
                    v-if="modify"
                    @click="this.location.reload()">{{ __('msg.CANCEL') }}</button>
                <button type="button" class="btn btn-point-sub"
                    v-if="modify"
                    @click="_delete">{{ __('msg.DEL') }}</button>
                <button class="btn btn-primary"
                    v-if="modify">{{ __('msg.SAVE') }}</button>
                @if($Experience->CircuitConfirmYn === 0
                    && session('auth.AdminRoleID') === 3 )
                    <button type="button"
                        v-if="!modify"
                        @click="_setCircuitConfirm"
                        class="btn btn-primary">{{ __('msg.SUBMIT') }}</button>
                @endif
                @if($Experience->CircuitConfirmYn === 1
                    && $Experience->BranchConfirmYn === 0
                    && session('auth.AdminRoleID') === 2)
                    <button type="button"
                        v-if="!modify"
                        @click="_setBranchConfirm"
                        class="btn btn-primary">{{ __('msg.REVIEW_INFO') }}</button>
                @endif
            @else
                <button type="button" class="btn btn-secondary"
                    onclick="location.href = '/{{ getTopPath() }}'">{{ __('msg.CANCEL') }}</button>
                <button type="submit" class="btn btn-primary">
                    {{ __('msg.SAVE') }} </button>
            @endif
            </div>
        </div>
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
    <form ref="formCircuitConfirm" method="POST">
        @method("PATCH")
        @csrf
    </form>
    <form ref="formBranchConfirm" method="POST">
        @csrf
    </form>
</section>
@endsection
@section('popup')
<modal-search
    v-if="showModal === 'modalSearch'"
    :circuit-id="CircuitID"
    @selected="_selected"
    @close="showModal = ''"
>
{{--  {{  dd($Experience) }}  --}}
</modal-search>
@endsection
@section('script')
@include('report.modalSearch')
<script>
    var app = new Vue({
        el: '#wrapper-body',
        data: {
            PublisherID: "{{ old('PublisherID') ?? $Experience->PublisherID ?? '' }}",
            Contents: "{{ old('Contents') ?? $Experience->Contents ?? '' }}",
            showModal: '',
            PublisherName: "{{ old('PublisherName') ?? $Experience->PublisherName ?? '' }}",
            PublisherGender: "{{ old('PublisherGender') ?? $Experience->PublisherGender ?? '' }}",
            CongregationName: "{{ old('CongregationName') ?? $Experience->CongregationName ?? '' }}",
            PublisherMobile: "{{ old('PublisherMobile') ?? $Experience->PublisherMobile ?? '' }}",
            modify: {{ isset($Experience->ExperienceID) ? 'false' : 'true' }},
            CircuitID: "{{ session('auth.CircuitID') }}",
        },
        watch: {
            Mobile: function() {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods: {
            _confirm: function(e) {
                var res = confirm('{{ isset($Experience->ExperienceID) ? __('msg.EDIT') : __('msg.SAVE') }}');
                if (!res) {
                    e.preventDefault();
                }
            },
            _showModal: function(modalName) {
                this.showModal = modalName;
            },
            _selected: function(data) {
                console.log(data);
                for (var key in data) {
                    this.$data[key] = data[key];
                }
            },
            _export:function () {
                location.href = '/{{ request()->path() }}/export';
            },
            _delete: function () {
                if( confirm( '{{ __('msg.WISH_DELETE') }}' )) this.$refs.formDelete.submit()
            },
            _setCircuitConfirm: function () {
                if( confirm( '{{ __('msg.WISH_SUBMIT')}}' )) this.$refs.formCircuitConfirm.submit()
            },
            _setBranchConfirm: function () {
                if( confirm( '{{ __('msg.WISH_REVIEW') }}' )) this.$refs.formBranchConfirm.submit()
            }

        }
    })
</script>
@endsection
