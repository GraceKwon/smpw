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
                    <label class="label" for="OrderNum">{{ __('msg.PRI') }}</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select @error('OrderNum') is-invalid @enderror"
                            id="OrderNum"
                            name="OrderNum"
                            v-model="OrderNum">
                            <option value="" selected>{{ __('msg.P_SELECT') }}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                        </select>
                        @error('OrderNum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
                <th>
                    <label class="label" for="ZoneAlias">{{ __('msg.AREA_CODE') }}</label>
                </th>
                <td>
                    <input type="text"
                        class="form-control min-w-300px-desktop @error('ZoneAlias') is-invalid @enderror"
                        id="ZoneAlias"
                        name="ZoneAlias"
                        v-model="ZoneAlias"
                        placeholder="{{ __('msg.ENTER_CODE') }}">
                    @error('ZoneAlias')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="ZoneName">{{ __('msg.AREA_NAME') }}</label>
                </th>
                <td colspan="3">
                    <input type="text"
                        class="form-control min-w-300px-desktop  @error('ZoneName') is-invalid @enderror"
                        id="ZoneName"
                        name="ZoneName"
                        v-model="ZoneName"
                        placeholder="{{ __('msg.ENTER_NAME') }}">
                    @error('ZoneName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="Latitude">{{ __('msg.LA') }}</label>
                </th>
                <td>
                    <div class="register-form-container inline-responsive">
                        <input type="text"
                            class="form-control min-w-300px-desktop  @error('Latitude') is-invalid @enderror"
                            id="Latitude"
                            name="Latitude"
                            v-model="Latitude"
                            placeholder="{{ __('msg.LA_MAP_SELECT') }}"
                            readonly>
                        @error('Latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
                <th>
                    <label class="label" for="Longitude">{{ __('msg.LO') }}</label>
                </th>
                <td>
                    <div class="register-form-container inline-responsive">
                        <input type="text"
                            class="form-control min-w-300px-desktop  @error('Longitude') is-invalid @enderror"
                            id="Longitude"
                            name="Longitude"
                            v-model="Longitude"
                            placeholder="{{ __('msg.LO_MAP_SELECT') }}"
                            readonly>
                        @error('Longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">{{ __('msg.CHOOSE_MAP') }}</label>
                </th>
                <td colspan="3" style="position:relative">
                    <div ref="map" class="map p-3 text-muted font-size-80"></div>
                    <div>
                        <input type="text" placeholder="{{ __('msg.ONLY_ADDR_ENTER') }}"
                            @keyup.enter="_addressSearch"
                            v-model="search">
                        <button type="button" class="btn-xsm btn-primary"
                            @click="_addressSearch">{{ __('msg.SEARCH') }}</button>
                        <span class="text-center" v-html="alertMessage"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="ZoneAddress">{{ __('msg.AA') }}</label>
                </th>
                <td colspan="3">
                    <input type="text"
                        class="form-control @error('ZoneAddress') is-invalid @enderror"
                        id="ZoneAddress"
                        name="ZoneAddress"
                        v-model="ZoneAddress"
                        placeholder="{{ __('msg.DISPLAY_MAP_ADDR_SELECTED') }}"
                        readonly>
                    @error('ZoneAddress')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            </tbody>
        </table>

        @include('layouts.sections.formButton', [
            'id' => isset($ServiceZone->ServiceZoneID),
        ])

    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
</section>
@endsection

@section('script')
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1a62bf5219322c8e2986927437b48d8d&libraries=services"></script>
<script>
    //TODO MAP 에 대한 지원을 어떻게 할건인가?
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            container: null,
            geocoder: null,
            map: null,
            marker: null,
            search: '',
            alertMessage: '',
            OrderNum: "{{ old('OrderNum') ?? $ServiceZone->OrderNum ?? '' }}",
            ZoneAlias: "{{ old('ZoneAlias') ?? $ServiceZone->ZoneAlias ?? '' }}",
            ZoneName: "{{ old('ZoneName') ?? $ServiceZone->ZoneName ?? '' }}",
            Latitude: "{{ old('Latitude') ?? $ServiceZone->Latitude ?? '' }}",
            Longitude: "{{ old('Longitude') ?? $ServiceZone->Longitude ?? '' }}",
            // Latitude: "3",
            // Longitude: "4",
            ZoneAddress: "{{ old('ZoneAddress') ?? $ServiceZone->ZoneAddress ?? '' }}",
        },
        mounted: function () {
            this._loadKakaoMap()

            // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
            kakao.maps.event.addListener(this.map, 'click',
                function(mouseEvent) {
                    // 클릭한 위도, 경도 정보를 가져옵니다
                    var latlng = mouseEvent.latLng;

                    // 마커 위치를 클릭한 위치로 옮깁니다
                    this.marker.setPosition(latlng);
                    this.marker.setMap(this.map);

                    this.geocoder.coord2Address(latlng.getLng(), latlng.getLat(),
                        function(result, status) {
                            var address = '';
                            if (status === kakao.maps.services.Status.OK) {
                                address = result[0].road_address ?
                                    result[0].road_address.address_name + '(도로명)' :
                                    result[0].address.address_name + '(지번)';
                            }
                            // document.getElementById('ZoneAddress').value = address;
                            this.ZoneAddress = address;
                        }.bind(this))
                        // document.getElementById('Latitude').value = latlng.getLat();
                        // document.getElementById('Longitude').value = latlng.getLng();
                        this.Latitude = latlng.getLat();
                        this.Longitude = latlng.getLng();

                }.bind(this));

        },
        methods:{
            _loadKakaoMap: function (e) {
                this.container = this.$refs.map; //지도를 담을 영역의 DOM 레퍼런스
                var options = { //지도를 생성할 때 필요한 기본 옵션
                    center: new kakao.maps.LatLng(37.00124464023314, 127.19440172814731), //지도의 중심좌표.
                    level: 3 //지도의 레벨(확대, 축소 정도)
                };
                this.map = new kakao.maps.Map(this.container, options); //지도 생성 및 객체 리턴
                console.log(this.map);
                var mapTypeControl = new kakao.maps.MapTypeControl(); // 맵타입을 제어할 수 있는 컨트롤을 생성합니다
                var zoomControl = new kakao.maps.ZoomControl(); // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
                this.map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
                this.map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

                this.geocoder = new kakao.maps.services.Geocoder(); // 주소-좌표 변환 객체를 생성합니다


                this.map.setCenter(new kakao.maps.LatLng(this.Latitude, this.Longitude))
                this.marker = new kakao.maps.Marker({
                    position: new kakao.maps.LatLng(this.Latitude, this.Longitude)
                }); //마커 객체를 생성합니다.

                this.marker.setMap(this.map);

            },
            _addressSearch: function() {
                var alertMessage = '';

                this.geocoder.addressSearch(this.search,
                    function(result, status) {
                        // 정상적으로 검색이 완료됐으면
                        if (status === kakao.maps.services.Status.OK) {

                            var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                            // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                            this.map.setCenter(coords);
                        }else{
                            alertMessage = '검색결과가 없습니다.'
                        }
                        this.alertMessage = alertMessage;
                    }.bind(this));
            },
            _confirm: function (e) {
                var res = confirm('{{ isset($ServiceZone->ServiceZoneID) ? '수정' : '저장' }} 하시겠습니까?');
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
