@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    <form method="POST"
        @keydown.enter.prevent>
        @method("PUT")
        @csrf
        <table class="table table-register">
            <tbody>
            <tr>
                <th>
                    <label class="label">{{ __('msg.NAME_PERSON') }} {{ __('msg.NAME') }}</label>
                </th>
                <td>
                    {{ $KeepZone->AdminName ?? session('auth.AdminName') }}
                </td>
                <th>
                    <label class="label">{{ __('msg.CITY') }}</label>
                </th>
                <td>
                    {{ $KeepZone->MetroName ?? getMetroName() }}
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">{{ __('msg.AREA') }}({{ __('msg.A') }})</label>
                </th>
                <td>
                    {{ $KeepZone->CircuitName ?? getCircuitName() }}
                </td>
                <th>
                    <label class="label">{{ __('msg.CGN') }}</label>
                </th>
                <td>
                    {{ $KeepZone->CongregationName ?? getCongregationName() }}
                </td>
            </tr>
            <tr>
                {{-- <th>
                    <label class="label">신분</label>
                </th>
                <td>
                </td> --}}
                <th>
                    <label class="label">{{ __('msg.TEL') }}</label>
                </th>
                <td>
                    {{ $KeepZone->Mobile ?? getMobile() }}
                </td>
            </tr>
            <tr>
                <th rowspan="2">
                    <label class="label">{{ __('msg.ADDR') }}</label>
                </th>
                <td colspan="3">
                    <div class="inline-responsive">
                        <div class="search-form flex">
                            <input type="text" class="form-control @error('ZipCode') is-invalid @enderror"
                                name="ZipCode"
                                v-model="ZipCode"
                                placeholder="{{ __('msg.ZIP') }}"
                                @click="_execDaumPostcode"
                                readonly>
                            <button type="button" class="btn btn-secondary"
                                @click="_execDaumPostcode">{{ __('msg.FIND_ZIP') }}</button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="pt-0-mobile" colspan="3">
                    <input type="text" class="form-control @error('ZoneAddress') is-invalid @enderror"
                        name="ZoneAddress"
                        v-model="ZoneAddress"
                        placeholder="{{ __('msg.ADDR') }}"
                        readonly>
                    @error('ZoneAddress')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="inline-responsive">
                        <input type="text" class="form-control @error('ZoneAddressDetail') is-invalid @enderror"
                            ref="ZoneAddressDetail"
                            name="ZoneAddressDetail"
                            v-model="ZoneAddressDetail"
                            placeholder="{{ __('msg.DETAIL_ADDR') }}">
                        @error('ZoneAddressDetail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
        <div ref="layer"
            style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
            <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
                style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1"
                @click="_closeDaumPostcode" alt="{{ __('msg.CLOSE') }}">
        </div>
        @include('layouts.sections.formButton', [
                'id' => isset($KeepZone->KeepZoneID) ? true : false,
            ])
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
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
            ZipCode: "{{ old('ZipCode') ?? $KeepZone->ZipCode ?? '' }}",
            ZoneAddress: "{{ old('ZoneAddress') ?? $KeepZone->ZoneAddress ?? '' }}",
            ZoneAddressDetail: "{{ old('ZoneAddressDetail') ?? $KeepZone->ZoneAddressDetail ?? '' }}",
            layer: null,
            width:320, //우편번호서비스가 들어갈 element의 width
            height: 400, //우편번호서비스가 들어갈 element의 height
            borderWidth: 2, //샘플에서 사용하는 border의 두께
            borderWidth: 2, //샘플에서 사용하는 border의 두께
        },
        mounted: function () {
            this.layer = this.$refs.layer;
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
                        this.ZoneAddress = addr + ' ' + extraAddr;
                        // 커서를 상세주소 필드로 이동한다.
                        this.$refs.ZoneAddressDetail.focus();

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
            _delete: function () {
                this.$refs.formDelete.submit()
            },

        }
    })
</script>
@endsection
