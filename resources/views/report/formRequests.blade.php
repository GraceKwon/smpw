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
                    <div>{{ $VisitRequest->PublisherName }}</div>
                </td>
                <th>
                    <label class="label">성별</label>
                </th>
                <td>
                    <div>{{ $VisitRequest->PublisherGender }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">도시</label>
                </th>
                <td>
                    <div>{{ $VisitRequest->MetroName }}</div>
                </td>
                <th>
                    <label class="label">지역</label>
                </th>
                <td>
                    <div>{{ $VisitRequest->CircuitName }}</div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">회중</label>
                </th>
                <td>
                    <div>{{ $VisitRequest->CongregationName }}</div>
                </td>
                <th>
                    <label class="label">연락처</label>
                </th>
                <td>
                    <div>{{ $VisitRequest->CongregationName }}</div>
                </td>
            </tr>
            </tbody>
            <tbody :class="{ off : !modify }">
                <tr>
                    <th>
                        <label class="label">관심자이름</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input type="text" 
                                name="InsteresterName"
                                class="form-control @error('InsteresterName') is-invalid @enderror"  
                                :disabled="!modify"
                                v-model="InsteresterName">
                            @error('SetStartDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror 
                        </div>
                    </td>
                    <th>
                        <label class="label">성별</label>
                    </th>
                    <td>
                        <div class="check-group inline-responsive">
                            <div class="custom-control custom-radio" v-show="modify || Gender === 'M'">
                                <input type="radio" 
                                    class="custom-control-input @error('Gender') is-invalid @enderror"
                                    id="M" 
                                    value="M" 
                                    v-model="Gender" 
                                    name="Gender">
                                <label class="custom-control-label" 
                                    for="M">남자</label>
                            </div>
                            <div class="custom-control custom-radio" v-show="modify || Gender === 'F'">
                                <input type="radio" 
                                    class="custom-control-input @error('Gender') is-invalid @enderror" 
                                    id="F" 
                                    value="F" 
                                    v-model="Gender" 
                                    name="Gender">
                                <label class="custom-control-label" for="F">여자</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">국가</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <select class="custom-select @error('ZipCode') is-invalid @enderror"
                                name="Country"
                                :disabled="!modify"
                                v-model="Country">
                                <option value="한국" selected>한국</option>
                            </select>
                            @error('ZipCode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <th>
                        <label class="label">우편번호</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input type="text" 
                                class="form-control @error('ZipCode') is-invalid @enderror"  
                                name="ZipCode"
                                v-model="ZipCode"
                                :disabled="!modify"
                                @click="_execDaumPostcode"
                                readonly>
                            <button type="button" class="btn btn-secondary" 
                                :disabled="!modify"
                                @click="_execDaumPostcode">주소검색</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                            <label class="label">시/도</label>
                        </th>
                        <td>
                            <div class="inline-responsive">
                                <input type="text" 
                                    class="form-control @error('Sido') is-invalid @enderror"  
                                    name="Sido"
                                    v-model="Sido"
                                    :disabled="!modify"
                                    @click="_execDaumPostcode"
                                    readonly>
                            </div>
                        </td>
                    <th>
                        <label class="label">시/군/구</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input type="text" 
                                class="form-control @error('Sigungu') is-invalid @enderror"  
                                name="Sigungu"
                                v-model="Sigungu"
                                :disabled="!modify"
                                @click="_execDaumPostcode"
                                readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                            <label class="label">주소</label>
                        </th>
                        <td>
                            {{-- <div class="inline-responsive"> --}}
                                <input type="text" 
                                    class="form-control @error('AddressMain') is-invalid @enderror"  
                                    name="AddressMain"
                                    v-model="AddressMain"
                                    :disabled="!modify"
                                    @click="_execDaumPostcode"
                                    readonly>
                                @error('AddressMain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            {{-- </div> --}}
                            <div ref="layer" 
                                style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
                                <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" 
                                    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" 
                                    @click="_closeDaumPostcode" alt="닫기 버튼">
                            </div>
                        </td>
                    <th>
                        <label class="label">상세 주소</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input type="text" 
                                class="form-control @error('AddressDetail') is-invalid @enderror"  
                                name="AddressDetail"
                                ref="AddressDetail"
                                :disabled="!modify"
                                v-model="AddressDetail">
                            @error('AddressDetail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">연락처</label>
                    </th>
                    <td>
                        <div class="inline-responsive">
                            <input type="text" 
                                class="form-control @error('Mobile') is-invalid @enderror"  
                                name="Mobile"
                                :disabled="!modify"
                                v-model="Mobile">
                            @error('Mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror                    
                        </div>
                    </td>
                    <th>
                        <label class="label">이메일</label>
                    </th>
                    <td>
                        <input type="text" 
                            class="form-control @error('Email') is-invalid @enderror"  
                            name="Email"
                            :disabled="!modify"
                            v-model="Email">
                        @error('Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                     
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">연락원하는시간</label>
                    </th>
                    <td colspan="3">
                        <div class="inline-responsive">
                            <select class="custom-select"
                                name="RequestWeekday"
                                :disabled="!modify"
                                v-model="RequestWeekday">
                                <option value="일">일</option>
                                <option value="월">월</option>
                                <option value="화">화</option>
                                <option value="수">수</option>
                                <option value="목">목</option>
                                <option value="금">금</option>
                                <option value="토">토</option>
                            </select>
                            <select class="custom-select" 
                                name="RequestTime"
                                :disabled="!modify"
                                v-model="RequestTime">
                                <option value="오전 12:00">오전 12:00</option>
                                <option value="오전 01:00">오전 01:00</option>
                                <option value="오전 02:00">오전 02:00</option>
                                <option value="오전 03:00">오전 03:00</option>
                                <option value="오전 04:00">오전 04:00</option>
                                <option value="오전 05:00">오전 05:00</option>
                                <option value="오전 06:00">오전 06:00</option>
                                <option value="오전 07:00">오전 07:00</option>
                                <option value="오전 08:00">오전 08:00</option>
                                <option value="오전 09:00">오전 09:00</option>
                                <option value="오전 10:00">오전 10:00</option>
                                <option value="오전 11:00">오전 11:00</option>
                                <option value="오후 12:00">오후 12:00</option>
                                <option value="오후 01:00">오후 08:00</option>
                                <option value="오후 02:00">오후 08:00</option>
                                <option value="오후 03:00">오후 08:00</option>
                                <option value="오후 04:00">오후 08:00</option>
                                <option value="오후 05:00">오후 08:00</option>
                                <option value="오후 06:00">오후 08:00</option>
                                <option value="오후 07:00">오후 09:00</option>
                                <option value="오후 08:00">오후 09:00</option>
                                <option value="오후 09:00">오후 09:00</option>
                                <option value="오후 10:00">오후 10:00</option>
                                <option value="오후 11:00">오후 11:00</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">작성일자</label>
                    </th>
                    <td>
                        <div>{{ $VisitRequest->CreateDate }}</div>
                    </td>
                    <th>
                        <label class="label">처리일자</label>
                    </th>
                    <td>
                        <div>{{ $VisitRequest->AdminReceiptDate }}</div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="label">전도인의 설명</label>
                    </th>
                    <td colspan="3">
                        <textarea type="text" 
                            class="form-control w-100"
                            name="Contents" 
                            v-model="Contents" 
                            :disabled="!modify"
                            rows="5" 
                            placeholder="내용을 입력해 주세요."></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
            <div class="d-flex">
                <button type="button" 
                    class="btn btn-outline-secondary"
                    v-if="!modify"
                    onclick="location.href='/{{ getTopPath() }}'">목록</button>
                @if(session('auth.AdminRoleID') >= 3)
                    <button type="button" 
                        class="btn btn-secondary"
                        v-if="!modify"
                        @click="modify = true">수정</button>
                    <button class="btn btn-outline-secondary"
                        type="button"
                        v-if="modify"
                        @click="this.location.reload()">취소</button>
                    <button class="btn btn-primary"
                        v-if="modify">저장</button>
                @endif
            </div>
            <div class="d-flex">
                @if(empty($VisitRequest->AdminID)
                    && session('auth.AdminRoleID') >= 3)
                <button type="button" 
                    v-if="!modify"
                    @click="_setConfirm"
                    class="btn btn-primary">보조자확인</button>
                @endif

                @if(isset($VisitRequest->AdminID) 
                && session('auth.AdminRoleID') === 2
                && empty($VisitRequest->AdminReceiptDate))
                <button type="button" 
                    v-if="!modify"
                    @click="_setReceip"
                    class="btn btn-primary">전달처리</button>
                @endif
            </div>
        </div>
    </form>
    <form ref="formConfirm" method="POST">
        @method("PATCH")
        @csrf
    </form>
    <form ref="formReceip" method="POST">
        @csrf
    </form>
</section>
@endsection

@section('script')
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            InsteresterName: "{{ old('InsteresterName') ?? $VisitRequest->InsteresterName ?? '' }}",
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
            layer: null,
            width:320, //우편번호서비스가 들어갈 element의 width
            height: 400, //우편번호서비스가 들어갈 element의 height
            borderWidth: 2, //샘플에서 사용하는 border의 두께
            borderWidth: 2, //샘플에서 사용하는 border의 두께
            modify: false,
        },
        mounted: function () {
            this.layer = this.$refs.layer;
        },
        watch: {
            Mobile: function () {
                this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
            },
        },
        methods:{
            _execDaumPostcode: function() {
                new daum.Postcode({
                    oncomplete: function(data) {
                        // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                        var addr = ''; // 주소 변수
                        var extraAddr = ''; // 참고항목 변수

                        //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                            addr = data.roadAddress;
                        } else { // 사용자가 지번 주소를 선택했을 경우(J)
                            addr = data.jibunAddress;
                        }

                        // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                        if(data.userSelectedType === 'R'){
                            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                            if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                                extraAddr += data.bname;
                            }
                            // 건물명이 있고, 공동주택일 경우 추가한다.
                            if(data.buildingName !== '' && data.apartment === 'Y'){
                                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                            }
                            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                            if(extraAddr !== ''){
                                extraAddr = ' (' + extraAddr + ')';
                            }
                        }

                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                        this.ZipCode = data.zonecode;
                        var addrSplit = addr.split(' ');

                        this.Sido = addrSplit[0];
                        this.Sigungu = addrSplit[1];

                        var AddressMain = '';
                        for (let index = 2; index < addrSplit.length; index++) {
                            AddressMain += addrSplit[index];
                            AddressMain += ' ';
                        }
                        this.AddressMain = AddressMain + ' ' + extraAddr;
                        // 커서를 상세주소 필드로 이동한다.
                        this.$refs.AddressDetail.focus();

                        // iframe을 넣은 element를 안보이게 한다.
                        // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                        this.layer.style.display = 'none';
                    }.bind(this),
                    width : '100%',
                    height : '100%',
                    maxSuggestItems : 5
                }).embed(this.layer);

                // iframe을 넣은 element를 보이게 한다.
                this.layer.style.display = 'block';

                // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
                this._initLayerPosition();
            },
            _initLayerPosition: function(){
                // var width = 300; //우편번호서비스가 들어갈 element의 width
                // var height = 400; //우편번호서비스가 들어갈 element의 height
                // var borderWidth = 2; //샘플에서 사용하는 border의 두께

                // 위에서 선언한 값들을 실제 element에 넣는다.
                this.layer.style.width = this.width + 'px';
                this.layer.style.height = this.height + 'px';
                this.layer.style.border = this.borderWidth + 'px solid';

                if( (window.innerWidth || document.documentElement.clientWidth) < 992){

                    this.layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - this.width)/2 - this.borderWidth) + 'px';
                    this.layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - this.height)/2 - this.borderWidth) + 'px';
                }
            },
            _closeDaumPostcode: function() {
                // iframe을 넣은 element를 안보이게 한다.
                this.layer.style.display = 'none';
            },
            _confirm: function (e) {
                var res = confirm('수정 하시겠습니까?');
                if(!res){
                    e.preventDefault();
                }
                
            },
            _setConfirm: function () {
                if( confirm('방문요청을 확인처리 하시겠습니까?') ) this.$refs.formConfirm.submit()
            },
            _setReceip: function () {
                if( confirm('전달완료처리 하시겠습니까?') ) this.$refs.formReceip.submit()
            }

        }
    })

</script>
@endsection