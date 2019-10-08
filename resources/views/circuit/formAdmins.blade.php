@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    <form method="POST"
    @submit="_confirm"
    @keydown.enter.prevent>
    @method("PUT")
    @csrf
        <table class="table table-register">
            <tbody>
            @if(isset($Admin->AdminID))
            <tr>
                <th>
                    <label class="label" for="Account">아이디</label>
                </th>
                <td>
                </td>
                <th>
                    <label class="label" for="nameSearch">비밀번호초기화</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <button type="button" class="btn btn-primary">초기화</button>
                    </div>
                </td>
            </tr>
            @endif
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
                                <option value="{{ $AdminRole->ID }}">{{ $AdminRole->Item }}</option>
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
                        <select class="custom-select @error('CongregationID') is-invalid @enderror"
                            id="CongregationID"
                            name="CongregationID"
                            v-model="CongregationID">
                            <option value="">선택</option>
                            <option v-for="Congregation in CongregationList"
                                :value="Congregation.CongregationID">@{{ Congregation.CongregationName }}</option>
                        </select>
                        @error('CongregationID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
                <th>
                    <label class="label" for="ServantTypeID">신분</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select @error('ServantTypeID') is-invalid @enderror" 
                            id="ServantTypeID"
                            name="ServantTypeID"
                            v-model="ServantTypeID">
                            <option value="">선택</option>
                            @foreach ($ServantTypeList as $ServantType)
                                <option value="{{ $ServantType->ID }}">{{ $ServantType->Item }}</option>
                            @endforeach
                        </select>
                        @error('ServantTypeID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                    
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="Mobile">연락처</label>
                </th>
                <td colspan="3">
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

        @include('layouts.sections.formButton', [
            'id' => isset($Admin->AdminID) ? true : false,
        ])

    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
</section>
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            AdminName: "{{ old('AdminName') ?? $Admin->AdminName ?? '' }}",
            AdminRoleID: "{{ old('AdminRoleID') ?? $Admin->AdminRoleID ?? '' }}",
            MetroID: "",
            CircuitID: "",
            ServantTypeID: "{{ old('ServantTypeID') ?? $Admin->ServantTypeID ?? '' }}",
            CongregationID: "{{ old('CongregationID') ?? $Admin->CongregationID ?? '' }}",
            Mobile: "{{ old('Mobile') ?? $Admin->Mobile ?? '' }}",
            CircuitList: [],
            CongregationList: [],
        },
        mounted: function(){
            this.MetroID = "{{ old('MetroID') ?? $Admin->MetroID ?? '' }}";
            this.CircuitID = "{{ old('CircuitID') ?? $Admin->CircuitID ?? '' }}";
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
            MetroID: function () {
                var params = {
                    params: {
                        MetroID: this.MetroID 
                    }
                };
                axios.get('/api/getCircuitList', params)
                    .then(function (response) {
                        console.log(response.data);
                        this.CircuitList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            },
            CircuitID: function () {
                var params = {
                    params: {
                        CircuitID: this.CircuitID 
                    }
                };
                axios.get('/api/getCongregationList', params)
                    .then(function (response) {
                        console.log(response.data);
                        this.CongregationList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            }
        },
        methods:{
            _confirm: function (e) {
                var res = confirm('{{ isset($Admin->AdminID) ? '수정' : '저장' }} 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                }
                
            },
            _delete: function () {
                console.log(this.$refs.formRemove);
                this.$refs.formDelete.submit()
            }
        }
    })

</script>
@endsection
