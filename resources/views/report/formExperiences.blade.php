@extends('layouts.frames.master') @section('content')
<section class="register-section">
    @error('fail')
    <div class="alert alert-danger">{!! $message !!}</div>
    @enderror @if(session('success'))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
    @endif @error('PublisherID')
    <div class="alert alert-danger">봉사자를 조회하여 선택해 주세요</div>
    @enderror
    <form method="POST" @submit="_confirm" @keydown.enter.prevent>
        @method("PUT") @csrf
        <table class="table table-register">
            <tbody>
                <tr>
                    <th>
                        <label class="label">작성자이름</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->AdminName ?? session('auth.AdminName') }}
                        </div>
                    </td>
                    <th>
                        <label class="label">연락처</label>
                    </th>
                    <td>
                        <div>{{ $Experience->AdminMobile ?? getMobile() }}</div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">도시</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->MetroName ?? getMetroName() }}
                        </div>
                    </td>
                    <th>
                        <label class="label">지역</label>
                    </th>
                    <td>
                        <div>
                            {{ $Experience->CircuitName ?? getCircuitName() }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">작성일자</label>
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
                        <label class="label">전도인이름</label>
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
                                봉사자 조회
                            </button>
                        </div>
                        <input
                            type="hidden"
                            name="PublisherID"
                            v-model="PublisherID"
                        />
                    </td>
                    <th>
                        <label class="label">성별</label>
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
                        <label class="label">회중명</label>
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
                        <label class="label">연락처</label>
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
                        <label class="label">경험담내용</label>
                    </th>
                    <td colspan="3">
                        <textarea
                            type="text"
                            class="form-control w-100 @error('Contents') is-invalid @enderror"
                            name="Contents"
                            v-model="Contents"
                            :disabled="!modify"
                            rows="5"
                            placeholder="경험담을 입력해 주세요."
                        >
                        </textarea>
                        @error('Contents')
                        <div class="invalid-feedback">
                            경험담을 입력해 주세요.
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
                    엑셀파일 다운로드
                </button>
                @endif
            </div>
            <div class="d-flex">
            @if( isset($Experience->ExperienceID) )
                <button type="button" 
                    class="btn btn-outline-secondary"
                    v-if="!modify"
                    onclick="location.href='/{{ getTopPath() }}'">목록</button>
                <button type="button" 
                    class="btn btn-secondary"
                    v-if="!modify"
                    @click="modify = true">수정</button>
                <button class="btn btn-outline-secondary"
                    type="button"
                    v-if="modify"
                    @click="this.location.reload()">취소</button>
                <button type="button" class="btn btn-point-sub"
                    v-if="modify"
                    @click="_delete">삭제</button>
                <button class="btn btn-primary"
                    v-if="modify">저장</button>
                @if($Experience->CircuitConfirmYn === 0
                    && session('auth.AdminRoleID') === 3 )
                    <button type="button" 
                        v-if="!modify"
                        @click="_setCircuitConfirm"
                        class="btn btn-primary">제출</button>
                @endif
                @if($Experience->CircuitConfirmYn === 1 
                    && $Experience->BranchConfirmYn === 0
                    && session('auth.AdminRoleID') === 2)
                    <button type="button" 
                        v-if="!modify"
                        @click="_setBranchConfirm"
                        class="btn btn-primary">열람내용확인</button>
                @endif
            @else
                <button type="button" class="btn btn-secondary" 
                    onclick="location.href = '/{{ getTopPath() }}'">취소</button>
                <button type="submit" class="btn btn-primary">
                    저장</button>
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
                var res = confirm('{{ isset($Experience->ExperienceID) ? '수정 ' : '저장 ' }} 하시겠습니까?');
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
                if( confirm('삭제 하시겠습니까?') ) this.$refs.formDelete.submit()
            },
            _setCircuitConfirm: function () {
                if( confirm('제출 하시겠습니까?') ) this.$refs.formCircuitConfirm.submit()
            },
            _setBranchConfirm: function () {
                if( confirm('열람내용확인 하시겠습니까?') ) this.$refs.formBranchConfirm.submit()
            }

        }
    })
</script>
@endsection
