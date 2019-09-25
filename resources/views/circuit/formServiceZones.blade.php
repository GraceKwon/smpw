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
            <tr>
                <th>
                    <label class="label" for="OrderNum">우선 순위</label>
                </th>
                <td>
                    <div class="inline-responsive">
                        <select class="custom-select"
                        :class="{ 'is-invalid' : errors.has('OrderNum') }" 
                        v-validate="'required'"
                        name="OrderNum"
                        v-model="OrderNum">
                            <option value="" selected>선택해 주세요</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="invalid-feedback" v-html="errors.first('OrderNum')"></div>
                </td>
                <th>
                    <label class="label" for="ZoneAlias">구역 약호</label>
                </th>
                <td>
                    <input type="text" 
                    class="form-control min-w-300px-desktop" 
                    :class="{ 'is-invalid' : errors.has('ZoneAlias') }" 
                    v-validate="'required|max:5'"
                    name="ZoneAlias"
                    v-model="ZoneAlias"
                    placeholder="구역 약호를 입력해 주세요">
                    <div class="invalid-feedback" v-html="errors.first('ZoneAlias')"></div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="ZoneName">구역 명칭</label>
                </th>
                <td colspan="3">
                    <input type="text" 
                    class="form-control min-w-300px-desktop" 
                    :class="{ 'is-invalid' : errors.has('ZoneName') }" 
                    v-validate="'required|max:10'"
                    name="ZoneName"
                    v-model="ZoneName"
                    placeholder="구역 명칭을 입력해 주세요">
                    <div class="invalid-feedback" v-html="errors.first('ZoneName')"></div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="Latitude">위도</label>
                </th>
                <td>
                    <div class="register-form-container inline-responsive">
                        <input type="text" 
                        class="form-control min-w-300px-desktop"
                        :class="{ 'is-invalid' : errors.has('Latitude') }" 
                        v-validate="'required'"
                        name="Latitude" 
                        v-model="Latitude" 
                        placeholder="지도에 선택된 구역의 위도가 표시됩니다." 
                        readonly>
                        <div class="invalid-feedback" v-html="errors.first('Latitude')"></div>
                    </div>
                </td>
                <th>
                    <label class="label" for="Longitude">경도</label>
                </th>
                <td>
                    <div class="register-form-container inline-responsive">
                        <input type="text" 
                        class="form-control min-w-300px-desktop" 
                        :class="{ 'is-invalid' : errors.has('Longitude') }" 
                        v-validate="'required'"
                        name="Longitude" 
                        v-model="Longitude" 
                        placeholder="지도에 선택된 구역의 경도가 표시됩니다." 
                        readonly>
                        <div class="invalid-feedback" v-html="errors.first('Longitude')"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label">지도에서 선택</label>
                </th>
                <td colspan="3" style="position:relative">
                    <div ref="map" class="map p-3 text-muted font-size-80"></div>
                    <div>
                        <input type="text" placeholder="주소만 입력 가능합니다." 
                            @keyup.enter="_addressSearch" 
                            v-model="search">
                        <button type="button" class="btn-xsm btn-primary" 
                            @click="_addressSearch">검색</button>
                        <span class="text-center" v-html="alertMessage"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label class="label" for="ZoneAddress">구역 주소</label>
                </th>
                <td colspan="3">
                    <input type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid' : errors.has('ZoneAddress') }" 
                    v-validate="'required'"
                    name="ZoneAddress" 
                    v-model="ZoneAddress" 
                    placeholder="지도에 선택된 구역의 주소가 표시됩니다." 
                    readonly>
                    <div class="invalid-feedback" v-html="errors.first('ZoneAddress')"></div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="btn-flex-area justify-content-end">
            <button type="button" class="btn btn-secondary" 
            onclick="location.href = '/{{ getTopPath() }}'">취소</button>
            
            @if(session('auth.CircuitID'))
                @if(isset($ServiceZone->ServiceZoneID))
                    <button type="button" class="btn btn-point-sub"
                        @click="_delete">삭제</button>
                @endif

                <button type="submit" class="btn btn-primary">
                    {{ isset($ServiceZone->ServiceZoneID) ? '수정' : '저장' }}</button>
            @endif
        </div> <!-- /.register-btn-area -->
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
</section>
@endsection

@section('script')
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=10f0647488c1c161a2bb5cbc32269402&libraries=services"></script>
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            container: null,
            geocoder: null,
            map: null,
            marker: null,
            search: '',
            alertMessage: '',
            OrderNum:"{{ isset($ServiceZone->OrderNum) ? $ServiceZone->OrderNum : '' }}",
            ZoneAlias:"{{ isset($ServiceZone->ZoneAlias) ? $ServiceZone->ZoneAlias : '' }}",
            ZoneName:"{{ isset($ServiceZone->ZoneName) ? $ServiceZone->ZoneName : '' }}",
            Latitude:"{{ isset($ServiceZone->Latitude) ? $ServiceZone->Latitude : '' }}",
            Longitude:"{{ isset($ServiceZone->Longitude) ? $ServiceZone->Longitude : '' }}",
            ZoneAddress:"{{ isset($ServiceZone->ZoneAddress) ? $ServiceZone->ZoneAddress : '' }}",
        },
        mounted: function () {
            this._loadKakaoMap()
        
            @if(session('auth.CircuitID'))
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

            @endif
        },
        methods:{
            _loadKakaoMap: function (e) {
                this.container = this.$refs.map; //지도를 담을 영역의 DOM 레퍼런스
                var options = { //지도를 생성할 때 필요한 기본 옵션
                    center: new kakao.maps.LatLng(this.Latitude ? this.Latitude : 37.00124464023314, 
                    this.Longitude ? this.Longitude : 127.19440172814731), //지도의 중심좌표.
                    level: 3 //지도의 레벨(확대, 축소 정도)
                };
                this.map = new kakao.maps.Map(this.container, options); //지도 생성 및 객체 리턴
                var mapTypeControl = new kakao.maps.MapTypeControl(); // 맵타입을 제어할 수 있는 컨트롤을 생성합니다
                var zoomControl = new kakao.maps.ZoomControl(); // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
                this.map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
                this.map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);
                
                this.geocoder = new kakao.maps.services.Geocoder(); // 주소-좌표 변환 객체를 생성합니다
                
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
            _validate: function (e) {
                var res = confirm('{{ isset($ServiceZone->ServiceZoneID) ? '수정' : '저장' }} 하시겠습니까?');
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