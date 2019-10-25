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
        <tr>
            <th>
                <label class="label" for="Account">아이디</label>
            </th>
            <td>
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
            <th rowspan="{{ 5 + ( isset($Publisher->PublisherID) ? 1 : 0 ) }}">
                <label class="label">사진</label>
            </th>
            <td rowspan="{{ 5 + ( isset($Publisher->PublisherID) ? 1 : 0 ) }}">
                <div class="photo-container">
                    <div class="photo-wrap">
                        <img src="../img/demo/demo-profile-thumbnail.png" class="thumbnail">
                        <input type="hidden" name="PhotoFilePath" v-model="PhotoFilePath">
                    </div>
                </div>
            </td>
        </tr>
        @if(isset($Publisher->PublisherID))
        <tr>
            <th>
                <label class="label" for="register02">비밀번호초기화</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <button type="button" class="btn btn-primary" 
                        @click="_resetPwd">비밀번호초기화</button>
                </div>
            </td>
        </tr>
        @endif
        <tr>
            <th>
                <label class="label" for="PublisherName">이름</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" 
                        class="form-control @error('PublisherName') is-invalid @enderror" 
                        id="PublisherName" 
                        name="PublisherName" 
                        v-model="PublisherName" 
                        placeholder="이름을 입력해 주세요">
                        @error('PublisherName')
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
                        v-model="CongregationID" 
                        name="CongregationID">
                        <option value="">선택</option>
                        @foreach ($CongregationList as $Congregation)
                            <option value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
                        @endforeach
                    </select>
                    @error('CongregationID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">성별</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input @error('Gender') is-invalid @enderror"
                            id="M" 
                            value="M" 
                            v-model="Gender" 
                            name="Gender">
                        <label class="custom-control-label" for="M">형제</label>
                    </div>
                    <div class="custom-control custom-radio">
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
                <label class="label" for="Mobile">연락처</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text" 
                        class="form-control @error('CongregationID') is-invalid @enderror"
                        id="Mobile" 
                        name="Mobile" 
                        v-model="Mobile" 
                        placeholder="연락처를 입력해 주세요">
                    @error('Mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register05">봉사자 신분</label>
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
            <th>
                <label class="label" for="PioneerTypeID">봉사자 특권</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('PioneerTypeID') is-invalid @enderror" 
                        id="PioneerTypeID"
                        name="PioneerTypeID"
                        v-model="PioneerTypeID">
                        <option value="">선택</option>
                        @foreach ($PioneerTypeList as $PioneerType)
                            <option value="{{ $PioneerType->ID }}">{{ $PioneerType->Item }}</option>
                        @endforeach
                    </select>
                    @error('PioneerTypeID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">봉사상태</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input"
                            v-model="StopYn" 
                            id="StopN" 
                            value="0"
                            name="StopYn">
                        <label class="custom-control-label" for="StopN">봉사중</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input" 
                            v-model="StopYn" 
                            id="StopY" 
                            value="1"
                            name="StopYn">
                        <label class="custom-control-label" for="StopY">봉사중단</label>
                    </div>
                </div>
            </td>
            <th>
                <label class="label">지원가능여부</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="check-group inline-responsive">
                        <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input @error('SupportYn') is-invalid @enderror" 
                            v-model="SupportYn" 
                            id="SupportY" 
                            value="1"
                            name="SupportYn">
                        <label class="custom-control-label" for="SupportY">가능</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input @error('SupportYn') is-invalid @enderror" 
                            v-model="SupportYn" 
                            id="SupportN" 
                            value="0"
                            name="SupportYn">
                        <label class="custom-control-label" for="SupportN">불가능</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register07">메모</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <textarea type="text" 
                        class="form-control w-100 @error('Memo') is-invalid @enderror"  
                        id="Memo" 
                        name="Memo" 
                        v-model="Memo" 
                        rows="5" 
                        placeholder="메모를 입력해 주세요."></textarea>
                    @error('Memo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="EndDate">계정중단일</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="input-group max-w-250px-desktop">
                        <input type="date" 
                            class="form-control @error('EndDate') is-invalid @enderror" 
                            id="EndDate" 
                            name="EndDate" 
                            v-model="EndDate" 
                            :disabled="StopYn === '0'"
                            placeholder="날자를 선택해 주세요">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div> --}}
                        @error('EndDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror 
                    </div>
                </div>
            </td>
            <th>
                <label class="label" for="register09">계정중단사유</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('EndTypeID') is-invalid @enderror" 
                        id="EndTypeID"
                        name="EndTypeID"
                        :disabled="StopYn === '0'"
                        v-model="EndTypeID">
                        <option value="">선택</option>
                        @foreach ($EndTypeIDList as $EndTypeID)
                            <option value="{{ $EndTypeID->ID }}">{{ $EndTypeID->Item }}</option>
                        @endforeach
                    </select>
                    @error('EndTypeID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    @include('layouts.sections.formButton', [
            'id' => isset($Publisher->PublisherID) ? true : false,
        ])
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
    <form ref="formResetPwd" method="POST">
        @csrf
    </form>
</section>

<section class="table-section mt-6">
    <h4 class="text-primary">봉사 타임 지정</h4>
    <div class="info-area form-inline mt-3">
        <form method="get">
            <select class="custom-select"
                onchange="submit()"
                name="ServiceYoil"
                v-model="ServiceYoil">
                <option value="월">월요일</option>
                <option value="화">화요일</option>
                <option value="수">수요일</option>
                <option value="목">목요일</option>
                <option value="금">금요일</option>
                <option value="토">토요일</option>
                <option value="일">일요일</option>
            </select>
        </form>
        {{-- <div class="form-control bg-primary border-primary text-white mt-1 mt-sm-0 ml-sm-2">2타임 배정</div> --}}
    </div>
    <form method="POST"
    @keydown.enter.prevent>
    @method("PATCH")
    @csrf
        <div class="table-area table-responsive mt-2">
            <table class="table table-bordered table-center font-size-90">
                <thead>
                <tr>
                    <th>
                        <label class="label">봉사타임</label>
                    </th>
                    @foreach ($ServiceZoneList as $ServiceZone)
                    <th>
                        <div class="min-w-100px">
                        <label class="label">{{ $ServiceZone->ZoneName }}</label>
                        </div>
                    </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach ($ServiceTimeList as $time => $ServiceTimes)
                    <tr>
                        <th>
                            <label class="label">{{ sprintfServiceTime($time) }}</label>
                        </th>
                        @foreach ($ServiceTimes as $ServiceTime)
                        <td @if( empty($ServiceTime) )
                            @elseif( $ServiceTime['ServiceSetType'] === '대기' )  
                                class="state-publisher-wait"
                            @elseif( $ServiceTime['ServiceSetType'] === '봉사자' )
                                class="state-publisher-set"
                            @elseif( $ServiceTime['ServiceSetType'] === '인도자' )
                                class="state-publisher-leader"
                            @endif>
                        @if( !empty($ServiceTime) )
                            <div class="form-inline">
                                <select class="custom-select mx-auto"
                                    name="ServiceSetType[{{ $ServiceTime['ServiceTimeID'] }}]">
                                    <option value="미지정" @if( $ServiceTime['ServiceSetType'] === '미지정' ) selected @endif>
                                        미지정
                                    </option>
                                    <option value="대기" @if( $ServiceTime['ServiceSetType'] === '대기' ) selected @endif>대기</option>
                                    <option value="봉사자" @if( $ServiceTime['ServiceSetType'] === '봉사자' ) selected @endif>봉사자</option>
                                    <option value="인도자" @if( $ServiceTime['ServiceSetType'] === '인도자' ) selected @endif>인도자</option>
                                </select>
                            </div>
                            <div class="mt-1 font-size-80">[{{ $ServiceTime['PublisherCnt'] }}/0]</div>
                        </td>  
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-inline align-items-center mt-3">
            <div class="min-w-140px text-primary">스케줄 변경 시작일</div>
            <div class="input-group mt-2 mt-md-0">
                <input type="date" class="form-control" placeholder="날자를 선택해 주세요">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-2 mt-md-0 ml-md-2">스케쥴 변경</button>
        </div>
    </form>
</section>
@endsection

@section('script')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            Account: "{{ $Publisher->Account ?? '' }}",
            PublisherName: "{{ old('PublisherName') ?? $Publisher->PublisherName ?? '' }}",
            CongregationID: "{{ old('CongregationID') ?? $Publisher->CongregationID ?? '' }}",
            Gender: "{{ old('Gender') ?? $Publisher->Gender ?? 'M' }}",
            Mobile: "{{ old('Mobile') ?? $Publisher->Mobile ?? '' }}",
            MobileOsKindID: "{{ old('MobileOsKindID') ?? $Publisher->MobileOsKindID ?? '' }}",
            PhotoFilePath: "{{ old('PhotoFilePath') ?? $Publisher->PhotoFilePath ?? '' }}",
            PioneerTypeID: "{{ old('PioneerTypeID') ?? $Publisher->PioneerTypeID ?? '' }}",
            ServantTypeID: "{{ old('ServantTypeID') ?? $Publisher->ServantTypeID ?? '' }}",
            StopYn: "{{ old('StopYn') ?? isset($Publisher->EndDate) ? '1' : '0' }}",
            SupportYn: "{{ old('SupportYn') ?? $Publisher->SupportYn ?? '1' }}",
            Memo: "{{ old('Memo') ?? $Publisher->Memo ?? '' }}",
            EndDate: "{{ old('EndDate') ?? $Publisher->EndDate ?? '' }}",
            EndTypeID: "{{ old('EndTypeID') ?? $Publisher->EndTypeID ?? '' }}",
            ServiceYoil: "{{ request('ServiceYoil') ?? '월' }}",
            ServiceSetType: "{{ request('ServiceYoil') ?? '월' }}",
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods:{
            _confirm: function (e) {
                var res = confirm('{{ isset($ServiceZone->ServiceZoneID) ? '수정' : '저장' }} 하시겠습니까?');
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