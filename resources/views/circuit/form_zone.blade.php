@extends('layouts.frames.master')
@section('content')
    <section class="section-register-wrap">
        <div class="register-form-item">
            <label class="label" for="register01">우선 순위</label>
            <div class="register-form-container inline-responsive">
                <select class="custom-select" id="register01">
                    <option selected>선택해 주세요</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register02">구역 약호</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register02" placeholder="구역 약호를 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register03">구역 명칭</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register03" placeholder="구역 명칭을 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register04">위도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register04" placeholder="위도를 입력해 주세요">
            </div>
        </div> <!-- /.search-form-item -->
        <div class="register-form-item">
            <label class="label" for="register05">경도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register05" placeholder="경도를 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label">지도에서 선택</label>
            <div class="register-form-container">
                <div class="register-map">
                    <div id="map" class="p-3 text-muted font-size-80" style="height:400px;">
                        {{-- <div id="map" style="width:500px;height:400px;"></div> --}}
                    </div>
                </div>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register06">구역 주소</label>
            <div class="register-form-container">
                <input type="text" class="form-control" id="register06" placeholder="지도에서 구역을 선택해 주세요">
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

    // 지도를 클릭한 위치에 표출할 마커입니다
    var marker = new kakao.maps.Marker({ 
        // 지도 중심좌표에 마커를 생성합니다 
        position: map.getCenter() 
    }); 
    // 지도에 마커를 표시합니다
    marker.setMap(map);

    // 지도에 클릭 이벤트를 등록합니다
    // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
    kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
        
        // 클릭한 위도, 경도 정보를 가져옵니다 
        var latlng = mouseEvent.latLng; 
        
        // 마커 위치를 클릭한 위치로 옮깁니다
        marker.setPosition(latlng);
        
        var message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
        message += '경도는 ' + latlng.getLng() + ' 입니다';
        
        console.log(message);
        
    });
</script>
@endsection