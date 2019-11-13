@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @error('PublisherID')
        <div class="alert alert-danger">봉사자를 조회하여 선택해 주세요</div>
    @enderror
    <form method="POST"
        @submit="_confirm" 
        @keydown.enter.prevent>
        @method("PUT")
        @csrf
        <table class="table table-register">
            <tbody>
            <tr>
                <th>
                    <label class="label">작성자이름</label>
                </th>
                <td>
                    <div>{{ $Experience->AdminName ?? session('auth.AdminName') }}</div>
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
                    <div>{{ $Experience->MetroName ?? getMetroName() }}</div>
                </td>
                <th>
                    <label class="label">순회구</label>
                </th>
                <td>
                    <div>{{ $Experience->CircuitName ?? getCircuitName() }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">작성일자</label>
                </th>
                <td colspan="3">
                    <div>{{ $Experience->CreateDate ?? date('Y-m-d') }}</div>
                </td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <th>
                    <label class="label">전도인이름</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" 
                            class="form-control"  
                            :disabled="!modify"
                            @click="_showModal('modalSearch')"
                            v-model="PublisherName">
                        <button type="button" class="btn btn-secondary" 
                            :disabled="!modify"
                            @click="_showModal('modalSearch')">봉사자 조회</button>
                    </div>
                    <input type="hidden" name="PublisherID" v-model="PublisherID">
                </td>
                <th>
                    <label class="label">성별</label>
                </th>
                <td>
                    <div v-html="PublisherGender"></div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">회중명</label>
                </th>
                <td>
                    <div v-html="CongregationName"></div>
                </td>
                <th>
                    <label class="label">연락처</label>
                </th>
                <td colspan="3">
                    <div v-html="PublisherMobile"></div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">경험담내용</label>
                </th>
                <td colspan="3">
                    <textarea type="text" 
                        class="form-control w-100 @error('Contents') is-invalid @enderror"  
                        name="Contents" 
                        v-model="Contents" 
                        :disabled="!modify"
                        rows="5" 
                        placeholder="경험담을 입력해 주세요.">
                    </textarea>
                    @error('Contents')
                        <div class="invalid-feedback">경험담을 입력해 주세요.</div>
                    @enderror  
                </td>
            </tr>
            </tbody>
        </table>
        @include('layouts.sections.formButton', [
            'id' => isset($Experience->ExperienceID),
        ])
    </form>

</section>
@endsection

@section('popup')
    <modal-search v-if="showModal === 'modalSearch'" 
        :circuit-id="CircuitID"
        @selected="_selected"
        @close="showModal = ''" >
    </modal-search>
@endsection

@section('script')
@include('report.modalSearch')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            PublisherID: "{{ old('PublisherID') ?? $Experience->PublisherID ?? '' }}",
            Contents: "{{ old('Contents') ?? $Experience->Contents ?? '' }}",
            showModal: '',
            PublisherName: "{{ $Experience->PublisherName }}",
            PublisherGender: "{{ $Experience->PublisherGender }}",
            CongregationName: "{{ $Experience->CongregationName }}",
            PublisherMobile: "{{ $Experience->PublisherMobile }}",
            modify: true,
            CircuitID: "{{ session('auth.CircuitID') }}",
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods:{
            _confirm: function (e) {
                var res = confirm('{{ isset($Experience->ExperienceID) ? '수정' : '저장' }} 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                }
            },
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
            _selected:function (data){
                console.log(data);
                for (var key in data) {
                    this.$data[key] = data[key];
                }
            },
            // _setConfirm: function () {
            //     if( confirm('방문요청을 확인처리 하시겠습니까?') ) this.$refs.formConfirm.submit()
            // },
            // _setReceip: function () {
            //     if( confirm('전달완료처리 하시겠습니까?') ) this.$refs.formReceip.submit()
            // }

        }
    })

</script>
@endsection
