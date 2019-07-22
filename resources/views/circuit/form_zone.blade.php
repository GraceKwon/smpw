@extends('layouts.frames.master')
@section('content')
    <section class="section-register-wrap">
        <form id="form">
            <div class="register-form-item">
                <label class="label" for="OrderNum">우선 순위</label>
                <div class="register-form-container inline-responsive">
                    <select class="custom-select" 
                        id="OrderNum" 
                        name="OrderNum" 
                        required>
                        <option value="0" selected>선택해 주세요</option>
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
                        name="ZoneAlias"
                        placeholder="구역 약호를 입력해 주세요"
                        required>
                </div>
            </div> <!-- /.register-form-item -->
            <div class="register-form-item">
                <label class="label" for="ZoneName">구역 명칭</label>
                <div class="register-form-container inline-responsive">
                    <input type="text" 
                        class="form-control min-w-300px-desktop" 
                        id="ZoneName" 
                        name="ZoneName" 
                        placeholder="구역 명칭을 입력해 주세요"
                        required>
                </div>
            </div> <!-- /.register-form-item -->
            <div class="register-form-item">
                <label class="label" for="Latitude">위도</label>
                <div class="register-form-container inline-responsive">
                    <input type="text" 
                        class="form-control min-w-300px-desktop" 
                        id="Latitude" 
                        name="Latitude" 
                        placeholder="지도에 선택된 구역의 위도가 표시됩니다." 
                        readonly
                        required>
                </div>
            </div> <!-- /.search-form-item -->
            <div class="register-form-item">
                <label class="label" for="Longitude">경도</label>
                <div class="register-form-container inline-responsive">
                    <input type="text" 
                        class="form-control min-w-300px-desktop" 
                        id="Longitude" 
                        name="Longitude" 
                        placeholder="지도에 선택된 구역의 경도가 표시됩니다." 
                        readonly
                        required>
                </div>
            </div> <!-- /.register-form-item -->
            <div class="register-form-item">
                <label class="label">지도에서 선택</label>
                <div class="register-form-container" style="position:relative">
                    <div class="register-map">
                        <div id="map" class="p-3 text-muted font-size-80" style="height:450px;position:relative;overflow:hidden;">
                                {{-- <div id="map" style="width:500px;height:400px;"></div> --}}
                        </div>
                        <div style="position:absolute ;top:0;left:0;margin:20px 0 0px 20px;padding:5px;overflow-y:auto;background:rgba(255, 255, 255, 0.8);z-index: 1;font-size:12px}">
                            <input type="text" id="AddressSearch" placeholder="주소만 입력 가능합니다.">
                            <button type="button" id="Button_AddressSearch" class="btn-xsm btn-primary">검색</button>
                            <span id="alert_message" class="text-center" style="display:block"></span>
                        </div>
                    </div>
                </div>
            </div> <!-- /.register-form-item -->
            <div class="register-form-item">
                <label class="label" for="ZoneAddress">구역 주소</label>
                <div class="register-form-container">
                    <input type="text" 
                        class="form-control" 
                        id="ZoneAddress" 
                        name="ZoneAddress" 
                        placeholder="지도에 선택된 구역의 주소가 표시됩니다." 
                        readonly
                        required>
                </div>
            </div> <!-- /.register-form-item -->
            <div class="register-btn-area">
                <button type="button" class="btn btn-secondary btn-responsive">취소</button>
                <button type="button" class="btn btn-primary btn-responsive">저장</button>
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
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=10f0647488c1c161a2bb5cbc32269402&libraries=services"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
    map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
    map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);
   
    // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
    kakao.maps.event.addListener(map, 'click', 
        function(mouseEvent) {        
            
            // 클릭한 위도, 경도 정보를 가져옵니다 
            var latlng = mouseEvent.latLng; 
            
            // 마커 위치를 클릭한 위치로 옮깁니다
            marker.setPosition(latlng);
            marker.setMap(map);
            
            geocoder.coord2Address(latlng.getLng(), latlng.getLat(), 
                function(result, status) {
                    var address = '';
                    if (status === kakao.maps.services.Status.OK) {
                        address = result[0].road_address ? 
                            result[0].road_address.address_name + '(도로명)' : 
                            result[0].address.address_name + '(지번)';
                    }
                    document.getElementById('ZoneAddress').value = address;
                })
            document.getElementById('Latitude').value = latlng.getLat();
            document.getElementById('Longitude').value = latlng.getLng();
            
        });

    function addressSearch() {
        var value = document.getElementById('AddressSearch').value;
        var alert_message = '';

        geocoder.addressSearch(value, 
            function(result, status) {
                // 정상적으로 검색이 완료됐으면 
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                    map.setCenter(coords);
                }else{
                    alert_message = '검색결과가 없습니다.'
                }
                document.getElementById('alert_message').innerHTML = alert_message;
            });  
    }

    $("#Button_AddressSearch").click(function(){ addressSearch(); });
    $("#AddressSearch").keyup(function(e){if(e.keyCode == 13) addressSearch(); });
    $("#form").validate({
        rules: {
            OrderNum: {
                selectcheck: true
            }
        }
    });
    $.extend( $.validator.messages, { 
        required: "필수 항목입니다.", 
        remote: "항목을 수정하세요.", 
        email: "유효하지 않은 E-Mail주소입니다.", 
        url: "유효하지 않은 URL입니다.", 
        date: "올바른 날짜를 입력하세요.", 
        dateISO: "올바른 날짜(ISO)를 입력하세요.", 
        number: "유효한 숫자가 아닙니다.", 
        digits: "숫자만 입력 가능합니다.", 
        creditcard: "신용카드 번호가 바르지 않습니다.", 
        equalTo: "같은 값을 다시 입력하세요.", 
        extension: "올바른 확장자가 아닙니다.", 
        maxlength: $.validator.format( "{0}자를 넘을 수 없습니다. " ), 
        minlength: $.validator.format( "{0}자 이상 입력하세요." ), 
        rangelength: $.validator.format( "문자 길이가 {0} 에서 {1} 사이의 값을 입력하세요." ), 
        range: $.validator.format( "{0} 에서 {1} 사이의 값을 입력하세요." ), 
        max: $.validator.format( "{0} 이하의 값을 입력하세요." ), 
        min: $.validator.format( "{0} 이상의 값을 입력하세요." ) } );

    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "선택해 주세요.");

</script>
@endsection