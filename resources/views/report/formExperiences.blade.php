@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">작성자이름</label>
            </th>
            <td>
                <div>{{ session('auth.AdminName') }}</div>
            </td>
            <th>
                <label class="label">연락처</label>
            </th>
            <td>
                <div>{{ getMobile() }}</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">도시</label>
            </th>
            <td>
                <div>{{ getMetroName() }}</div>
            </td>
            <th>
                <label class="label">순회구</label>
            </th>
            <td>
                <div>{{ getCircuitName() }}</div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">작성일자</label>
            </th>
            <td colspan="3">
                <div>{{ date('Y-m-d') }}</div>
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
                        class="form-control @error('PublisherName') is-invalid @enderror"  
                        name="PublisherName"
                        :disabled="!modify"
                        v-model="PublisherName">
                    @error('PublisherName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
            </td>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div class="check-group inline-responsive">
                    <div class="custom-control custom-radio"
                     {{-- v-show="modify || Gender === 'M'" --}}
                    >
                        <input type="radio" 
                            class="custom-control-input @error('Gender') is-invalid @enderror"
                            id="M" 
                            value="M" 
                            v-model="Gender" 
                            name="Gender">
                        <label class="custom-control-label" 
                            for="M">형제</label>
                    </div>
                    <div class="custom-control custom-radio"
                     {{-- v-show="modify || Gender === 'F'" --}}
                     >
                        <input type="radio" 
                            class="custom-control-input @error('Gender') is-invalid @enderror" 
                            id="F" 
                            value="F" 
                            v-model="Gender" 
                            name="Gender">
                        <label class="custom-control-label" for="F">자매</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">회중명</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select" id="CongregationID" name="CongregationID" onchange=";submit()">
                        @foreach ($CongregationList as $Congregation)
                            <option @if(request()->CongregationID == $Congregation->CongregationID ) selected @endif
                            value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <th>
                <label class="label">연락처</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <input type="text" class="form-control" id="register06" placeholder="연락처를 입력해 주세요.">

                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">경험담내용</label>
            </th>
            <td colspan="3">
                <textarea class="form-control" rows="5" placeholder="경험담 내용을 입력해 주세요"></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button type="button" class="btn btn-secondary">취소</button>
        <button type="button" class="btn btn-primary">저장</button>
    </div> <!-- /.register-btn-area -->
</section>
@endsection

@section('popup')
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            PublisherName: "{{ old('PublisherName') ?? $Experience->PublisherName ?? '' }}",
            Gender: "{{ old('Gender') ?? $VisitRequest->Gender ?? '' }}",
            Country: "{{ old('Country') ?? $VisitRequest->Country ?? '' }}",
            ZipCode: "{{ old('ZipCode') ?? $VisitRequest->ZipCode ?? '' }}",
            Sido: "{{ old('Sido') ?? $VisitRequest->Sido ?? '' }}",
            Sigungu: "{{ old('Sigungu') ?? $VisitRequest->Sigungu ?? '' }}",
            AddressMain: "{{ old('AddressMain') ?? $VisitRequest->AddressMain ?? '' }}",
            AddressDetail: "{{ old('AddressDetail') ?? $VisitRequest->AddressDetail ?? '' }}",
            Mobile: "{{ old('Mobile') ?? $VisitRequest->Mobile ?? '' }}",
            Email: "{{ old('Email') ?? $VisitRequest->Email ?? '' }}",
            RequestWeekday: "{{ old('RequestWeekday') ?? $VisitRequest->RequestWeekday ?? '' }}",
            RequestTime: "{{ old('RequestTime') ?? $VisitRequest->RequestTime ?? '' }}",
            Contents: "{{ old('Contents') ?? $VisitRequest->Contents ?? '' }}",
            modify: false,
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods:{
            _confirm: function (e) {
                var res = confirm('{{ isset($Admin->AdminID) ? '수정' : '저장' }} 하시겠습니까?');
                if(!res){
                    e.preventDefault();
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
