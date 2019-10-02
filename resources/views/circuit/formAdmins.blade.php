@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    <form method="POST"
        @submit="_validate" 
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
                            class="form-control" 
                            :class="{ 'is-invalid' : errors.has('AdminName') }" 
                            v-validate="'required|min:2|max:10'"
                            id="AdminName" 
                            name="AdminName" 
                            v-model="AdminName" 
                            placeholder="이름을 입력해 주세요">
                        <div class="invalid-feedback" v-html="errors.first('AdminName')"></div>
                    </div>
                </td>
                <th>
                    <label class="label" for="AdminRoleID">권한</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select" 
                            :class="{ 'is-invalid' : errors.has('AdminRoleID') }" 
                            v-validate="'required'"
                            id="AdminRoleID"
                            name="AdminRoleID"
                            v-model="AdminRoleID">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                        <div class="invalid-feedback" v-html="errors.first('AdminRoleID')"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="MetroID">도시</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select" 
                            :class="{ 'is-invalid' : errors.has('MetroID') }" 
                            v-validate="'required'"
                            id="MetroID"
                            name="MetroID"
                            v-model="MetroID">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                        <div class="invalid-feedback" v-html="errors.first('MetroID')"></div>
                    </div>
                </td>
                <th>
                    <label class="label" for="CircuitID">순회구(지역)</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select" 
                            :class="{ 'is-invalid' : errors.has('CircuitID') }" 
                            v-validate="'required'"
                            id="CircuitID"
                            name="CircuitID"
                            v-model="CircuitID">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                        <div class="invalid-feedback" v-html="errors.first('CircuitID')"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="CongregationID">회중</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select" 
                            :class="{ 'is-invalid' : errors.has('CongregationID') }" 
                            v-validate="'required'"
                            id="CongregationID"
                            name="CongregationID"
                            v-model="CongregationID">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                        <div class="invalid-feedback" v-html="errors.first('CongregationID')"></div>
                    </div>
                </td>
                <th>
                    <label class="label" for="ServantTypeID">신분</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select" 
                            :class="{ 'is-invalid' : errors.has('ServantTypeID') }" 
                            v-validate="'required'"
                            id="ServantTypeID"
                            name="ServantTypeID"
                            v-model="ServantTypeID">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                        <div class="invalid-feedback" v-html="errors.first('ServantTypeID')"></div>
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
                            class="form-control" 
                            :class="{ 
                                'is-invalid' : errors.has('Mobile'), 
                                'is-valid' : !errors.has('Mobile') && Mobile
                            }" 
                            id="Mobile" 
                            name="Mobile" 
                            v-model="Mobile" 
                            v-validate="{   
                                rules: { 
                                    required: true,
                                    regex:/^\d{2,3}-\d{3,4}-\d{4}$/,
                                }
                            }"
                            placeholder="연락처 번호를 입력해 주세요">
                        <div class="invalid-feedback" v-html="errors.first('Mobile')"></div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="btn-flex-area justify-content-end">
            <button type="button" class="btn btn-secondary" onclick="location.href = '/{{ getTopPath() }}'">취소</button>
            @if(isset($Admin->AdminID))
                <button type="button" class="btn btn-point-sub"
                    @click="_delete">삭제</button>
            @endif
                <button type="submit" class="btn btn-primary">
                    {{ isset($Admin->AdminID) ? '수정' : '저장' }}</button>
        </div> <!-- /.register-btn-area -->
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
            AdminName: "{{ isset($Admin->AdminName) ? $Admin->AdminName : '' }}",
            AdminRoleID: "{{ isset($Admin->AdminRoleID) ? $Admin->AdminRoleID : '' }}",
            MetroID: "{{ isset($Admin->MetroID) ? $Admin->MetroID : '' }}",
            CircuitID: "{{ isset($Admin->CircuitID) ? $Admin->CircuitID : '' }}",
            CongregationID: "{{ isset($Admin->CongregationID) ? $Admin->CongregationID : '' }}",
            ServantTypeID: "{{ isset($Admin->ServantTypeID) ? $Admin->ServantTypeID : '' }}",
            Mobile: "{{ isset($Admin->Mobile) ? $Admin->Mobile : '' }}",
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            }
        },
        methods:{
            _validate: function (e) {
                var res = confirm('{{ isset($Admin->AdminID) ? '수정' : '저장' }} 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                    console.log(res);
                }
                // return true;
                this.$validator.validateAll()
                .then(function (result) {
                    console.log(result);
                    if (!result) {
                        e.preventDefault();
                    } 
                })
                .catch(function (error) {
                    e.preventDefault();
                });
                
            },
            _delete: function () {
                console.log(this.$refs.formRemove);
                this.$refs.formDelete.submit()
            }
        }
    })

</script>
@endsection
