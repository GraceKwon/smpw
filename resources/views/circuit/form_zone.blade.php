@extends('layouts.frames.master')
@section('content')
    <section class="section-register-wrap">
        <div class="register-form-item">
            <label class="label" for="OrderNum">우선 순위</label>
            <div class="register-form-container inline-responsive">
                <select class="custom-select" id="OrderNum">
                    <option selected>선택해 주세요</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="ZoneAlias">구역 약호</label>
            <div class="register-form-container inline-responsive">
                <input type="text" 
                    class="form-control min-w-300px-desktop" 
                    id="ZoneAlias" 
                    placeholder="구역 약호를 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="ZoneName">구역 명칭</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="ZoneName" placeholder="구역 명칭을 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="Latitude">위도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="Latitude" placeholder="지도에 선택된 구역의 위도가 표시됩니다." readonly>
            </div>
        </div> <!-- /.search-form-item -->
        <div class="register-form-item">
            <label class="label" for="Longitude">경도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="Longitude" placeholder="지도에 선택된 구역의 경도가 표시됩니다." readonly>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label">지도에서 선택</label>
            <div class="register-form-container" style="position:relative">
                <div class="register-map">
                    <div id="map" class="p-3 text-muted font-size-80" style="height:400px;position:relative;overflow:hidden;">
                            {{-- <div id="map" style="width:500px;height:400px;"></div> --}}
                    </div>
                    <div style="position:absolute ;top:0;left:0;margin:20px 0 0px 20px;padding:5px;overflow-y:auto;background:rgba(255, 255, 255, 0.8);z-index: 1;font-size:12px}">
                        <input type="text" id="AddressSearch" placeholder="주소만 입력 가능합니다.">
                        <button type="button" class="btn-xsm btn-primary" onclick="addressSearch()">검색</button>
                    </div>
                </div>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="ZoneAddress">구역 주소</label>
            <div class="register-form-container">
                <input type="text" class="form-control" id="ZoneAddress" placeholder="지도에 선택된 구역의 주소가 표시됩니다." readonly>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-btn-area">
            <button type="button" class="btn btn-secondary btn-responsive">취소</button>
            <button type="button" class="btn btn-primary btn-responsive">저장</button>
        </div> <!-- /.register-btn-area -->
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
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=10f0647488c1c161a2bb5cbc32269402&libraries=services"></script>
<script>
    var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
    var options = { //지도를 생성할 때 필요한 기본 옵션
        center: new kakao.maps.LatLng(37.00132095369173, 127.19594107057598), //지도의 중심좌표.
        level: 3 //지도의 레벨(확대, 축소 정도)
    };
    var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
    var geocoder = new kakao.maps.services.Geocoder(); // 주소-좌표 변환 객체를 생성합니다
    var mapTypeControl = new kakao.maps.MapTypeControl(); // 맵타입을 제어할 수 있는 컨트롤을 생성합니다
    var zoomControl = new kakao.maps.ZoomControl(); // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
    var marker = new kakao.maps.Marker({
        // position: new kakao.maps.LatLng(37.00132095369173, 127.19594107057598)
    }); //마커 객체를 생성합니다.
    // marker.setMap(map);
    var infowindow = new kakao.maps.InfoWindow({zIndex:1});
    map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
    map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

   
   
 


    // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
    kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
        
        // 클릭한 위도, 경도 정보를 가져옵니다 
        var latlng = mouseEvent.latLng; 
        
        // 마커 위치를 클릭한 위치로 옮깁니다
        marker.setPosition(latlng);
        marker.setMap(map);
        
        geocoder.coord2Address(latlng.getLng(), latlng.getLat(), function(result, status) {
            if (status === kakao.maps.services.Status.OK) {
                var address = result[0].road_address ? 
                    result[0].road_address.address_name + '(도로명)' : 
                    result[0].address.address_name + '(지번)';
                document.getElementById('ZoneAddress').value = address;
            }
        })
        document.getElementById('Latitude').value = latlng.getLat();
        document.getElementById('Longitude').value = latlng.getLng();
        var message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
        message += '경도는 ' + latlng.getLng() + ' 입니다';
        
        console.log(message);
        
    });

    function addressSearch() {
        var value = document.getElementById('AddressSearch').value;
         geocoder.addressSearch(value, function(result, status) {

            // 정상적으로 검색이 완료됐으면 
            console.log(status); // 검색결과없을시 "ZERO_RESULT"
            console.log(kakao.maps.services.Status.OK);
            if (status === kakao.maps.services.Status.OK) {

                var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                map.setCenter(coords);
            } 
        });  
    }

</script>
@endsection