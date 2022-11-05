<!DOCTYPE html>
<body onload = "storeDownLoad()" >
<script type="text/javascript">
    function storeDownLoad() {
        const mobileType = navigator.userAgent.toLowerCase();

        if(mobileType.indexOf('android') > -1) {
            return window.location ="https://play.google.com/store/apps/details?id=org.jw.smpwko";
        }
        else if(mobileType.indexOf('iphone') > -1 || mobileType.indexOf('ipad') > -1 || mobileType.indexOf('ipod') > -1) {
            return window.location = "https://apps.apple.com/us/app/대도시특별증거/id1645813618";
        }
        else {
            return window.location = "https://smpw.or.kr/login";
            // "해당 마켓에서 앱을 검색해주세요!" 나는 예외처리를 하였다..
        }
    }
</script>
</body>
