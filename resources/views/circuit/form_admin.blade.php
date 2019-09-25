@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <form id="app" method="post"
    @submit="checkForm" 
    @keydown.enter.prevent>
        <table class="table table-register">
            <tbody>
            <tr>
                <th>
                    <label class="label" for="nameSearch">사용자 이름</label>
                </th>
                <td colspan="3">
                    <div class="inline-responsive">
                        <div class="search-form flex">
                            <input type="text" class="form-control" id="nameSearch" placeholder="조회할 이름을 입력해 주세요">
                            <button class="btn btn-secondary">조회</button>
                        </div>
                        <select class="custom-select" v-model="UserName">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="register02">도시</label>
                </th>
                <td colspan="3">
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register02" placeholder="이름을 선택해 주세요" disabled>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="register03">순회구</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register03" placeholder="이름을 선택해 주세요" disabled="">
                    </div>
                </td>
                <th>
                    <label class="label" for="register04">회중</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register04" placeholder="이름을 선택해 주세요" disabled="">
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="register05">신분</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register05" placeholder="이름을 선택해 주세요" disabled="">
                    </div>
                </td>
                <th>
                    <label class="label" for="register06">연락처</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <input type="text" class="form-control" id="register06" placeholder="이름을 선택해 주세요" disabled="">
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="register07">권한</label>
                </th>
                <td colspan="3">
                    <div class="register-form-container inline-responsive">
                        <select class="custom-select" id="register07">
                            <option selected="">선택</option>
                            <option>option</option>
                        </select>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="btn-flex-area justify-content-end">
            <button type="button" class="btn btn-secondary" onclick="location.href = '/{{ getTopPath() }}'">취소</button>
            <button type="submit" class="btn btn-primary">저장</button>
        </div> <!-- /.register-btn-area -->
    </form>
</section>
@endsection

@section('popup')
    <!-- <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-800px">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            <span>Modal layer popup</span>
                        </div>
                        <div class="mlp-close">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content">
                        점검중입니다
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-secondary btn-sm">취소</button>
                        <button class="btn btn-primary btn-sm">확인</button>
                    </div>
                </div>
            </div> 
        </div>
    </section> -->
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#app',
        data:{
            errors:{
                UserName:false,
            },
            UserName:"",
        },
        watch:{
            UserName:function() {
                if(this.UserName){
                    this.errors.UserName = false;
                }
            },
        },
        methods:{
            checkForm:function(e) {
                this.UserName = this.UserName.replace(/^\s*|\s*$/g, '');
 
                this.errors = {
                    UserName:false,
                    };
                if(this.UserName 
                    // && this.ZoneAlias
             
                    )
                {
                    return true;
                } 
                if(!this.UserName){
                    console.log('UserName');
                    this.errors.UserName = true;
                } 
                e.preventDefault();
            },
        }
    })

</script>
@endsection
