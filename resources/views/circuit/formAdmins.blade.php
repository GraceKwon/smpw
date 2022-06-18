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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST"
    @submit="_confirm"
    @keydown.enter.prevent>
    @method("PUT")
    @csrf
        <table class="table table-register">
            <tbody>
                <tr>
                    <th>
                        <label class="label" for="Account">아이디</label>
                    </th>
                    <td colspan="{{ ( isset($Admin->AdminID) ? 0 : 3 ) }}">
                        <div class="inline-responsive">
                            <input type="text"
                            class="form-control"
                            id="Account"
                            name="Account"
                            v-model="Account"
                            placeholder="자동으로 생성됩니다"
                            disabled>
                        </div>
                    </td>
                @if(isset($Admin->AdminID))
                <th>
                    <label class="label" for="nameSearch">비밀번호초기화</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <button type="button" class="btn btn-primary"
                            @click="_resetPwd">비밀번호초기화</button>
                    </div>
                </td>
                @endif
            </tr>
            <tr>
                <th>
                    <label class="label" for="AdminName">이름</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text"
                            class="form-control @error('AdminName') is-invalid @enderror"
                            id="AdminName"
                            name="AdminName"
                            v-model="AdminName"
                            placeholder="이름을 입력해 주세요">
                        @error('AdminName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
                <th>
                    <label class="label" for="AdminRoleID">권한</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select @error('AdminRoleID') is-invalid @enderror"
                            id="AdminRoleID"
                            name="AdminRoleID"
                            v-model="AdminRoleID">
                            <option value="">선택</option>
                            @foreach ($AdminRoleList as $AdminRole)
                                {{-- @if( session('auth.AdminRoleID') === 1
                                || ($AdminRole->Item === '순회감독자' || $AdminRole->Item === '순회구보조자' || $AdminRole->Item === '조정장로')
                                ) --}}
                                <option value="{{ $AdminRole->ID }}">{{ $AdminRole->Item }}</option>
                                {{-- @endif --}}
                            @endforeach
                        </select>
                        @error('AdminRoleID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="MetroID">도시</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select @error('MetroID') is-invalid @enderror"
                            id="MetroID"
                            name="MetroID"
                            v-model="MetroID">
                            <option value="">선택</option>
                            @foreach ($MetroList as $Metro)
                                <option value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
                            @endforeach
                        </select>
                        @error('MetroID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
                <th>
                    <label class="label" for="CircuitID">순회구(지역)</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select @error('CircuitID') is-invalid @enderror"
                            id="CircuitID"
                            name="CircuitID"
                            v-model="CircuitID">
                            <option value="">선택</option>
                            <option v-for="Circuit in CircuitList"
                                :value="Circuit.CircuitID">@{{ Circuit.CircuitName }}</option>
                        </select>
                        @error('CircuitID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="CongregationID">회중</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        {{-- <select class="custom-select @error('CongregationID') is-invalid @enderror" --}}
                        <select class="custom-select"
                            id="CongregationID"
                            name="CongregationID"
                            v-model="CongregationID">
                            <option value="">선택</option>
                            <option v-for="Congregation in CongregationList"
                                :value="Congregation.CongregationID">@{{ Congregation.CongregationName }}</option>
                        </select>
                        {{-- @error('CongregationID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </td>

                <th>
                    <label class="label" for="Mobile">연락처</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text"
                            class="form-control @error('Mobile') is-invalid @enderror"
                            :class="{
                                'is-valid' : !errors.has('Mobile') && Mobile
                            }"
                            id="Mobile"
                            name="Mobile"
                            v-model="Mobile"
                            v-validate="{
                                rules: {
                                    regex:/^\d{2,3}-\d{3,4}-\d{4}$/,
                                }
                            }"
                            placeholder="연락처 번호를 입력해 주세요">
                            @error('Mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="btn-flex-area justify-content-end">
            <button type="button" class="btn btn-secondary"
                onclick="location.href = '/{{ getTopPath() }}'">취소</button>
            @if(isset($Admin->AdminID))
                <button type="button" class="btn btn-point-sub"
                    @click="_delete">삭제</button>
            @endif
                <button type="submit" class="btn btn-primary">
                    {{ isset($Admin->AdminID) ? '수정' : '저장' }}</button>
        </div>

    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
    <form ref="formResetPwd" method="POST">
        @csrf
        <input type="hidden" name="Account" v-model="Account" />
        <input type="hidden" name="Mobile" v-model="Mobile" />
    </form>
</section>
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            Account: "{{ $Admin->Account ?? '' }}",
            AdminName: "{{ old('AdminName') ?? $Admin->AdminName ?? '' }}",
            AdminRoleID: "{{ old('AdminRoleID') ?? $Admin->AdminRoleID ?? '' }}",
            MetroID: "{{ old('MetroID') ?? $Admin->MetroID ?? '' }}",
            CircuitID: "{{ old('CircuitID') ?? $Admin->CircuitID ?? '' }}",
            ServantTypeID: "{{ old('ServantTypeID') ?? $Admin->ServantTypeID ?? '' }}",
            CongregationID: "{{ old('CongregationID') ?? $Admin->CongregationID ?? '' }}",
            Mobile: "{{ old('Mobile') ?? $Admin->Mobile ?? '' }}",
            CircuitList: [],
            CongregationList: [],
        },
        mounted: function(){
            this._getCircuitList();
            this._getCongregationList();
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
            MetroID: function () {
                this.CircuitID = '';
                this._getCircuitList();
            },
            CircuitID: function () {
                this.CongregationID = '';
                this._getCongregationList();
            }
        },
        methods:{
            _getCircuitList: function () {
                var params = {
                    params: {
                        MetroID: this.MetroID
                    }
                };
                axios.get('/getCircuitList', params)
                    .then(function (response) {
                        console.log(response.data);
                        this.CircuitList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            },
            _getCongregationList: function () {
                var params = {
                    params: {
                        CircuitID: this.CircuitID
                    }
                };
                axios.get('/getCongregationList', params)
                    .then(function (response) {
                        console.log(response.data);
                        this.CongregationList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            },
            _confirm: function (e) {
                var res = confirm('{{ isset($Admin->AdminID) ? '수정' : '저장' }} 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                }

            },
            _delete: function () {
                if( confirm('삭제 하시겠습니까?') ) this.$refs.formDelete.submit()
            },
            _resetPwd: function () {
                if( confirm('비밀번호를 초기화 하시겠습니까?') ) this.$refs.formResetPwd.submit()
            }
        }
    })

</script>
@endsection
