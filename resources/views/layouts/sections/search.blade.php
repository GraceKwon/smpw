<section class="search-section">

    @if(isset($MetroList))
    <div class="search-form-item">
        <label class="label" for="MetroID">도시</label>
        <select class="custom-select" id="MetroID" name="MetroID" onchange="submit()">
            <option value="">선택</option>
            @foreach ($MetroList as $Metro)
                <option @if(request('MetroID') == $Metro->MetroID ) selected @endif
                value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif

    @if(isset($CircuitList))
    <div class="search-form-item">
        <label class="label" for="CircuitID">순회구</label>
        <select class="custom-select" id="CircuitID" name="CircuitID" onchange="submit()">
            <option value="">선택</option>
            @foreach ($CircuitList as $Circuit)
                <option @if(request('CircuitID') == $Circuit->CircuitID ) selected @endif
                value="{{ $Circuit->CircuitID }}">{{ $Circuit->CircuitName }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif

    @if(isset($CongregationList))
    <div class="search-form-item">
        <label class="label" for="CongregationID">회중</label>
        <select class="custom-select" id="CongregationID" name="CongregationID" onchange="submit()">
            <option value="">선택</option>
            @foreach ($CongregationList as $Congregation)
                <option @if(request('CongregationID') == $Congregation->CongregationID ) selected @endif
                value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif

    @if(isset($AdminRoleList))
    <div class="search-form-item">
        <label class="label" for="AdminRoleID">권한</label>
        <select class="custom-select" id="AdminRoleID" nanme="AdminRoleID" onchange="submit()">
            <option selected>선택</option>
            @foreach ($AdminRoleList as $AdminRole)
                <option @if(request('AdminRoleID') == $AdminRole->ID ) selected @endif
                    value="{{ $AdminRole->ID }}">{{ $AdminRole->Item }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif

    @if(isset($ServantTypeList))
    <div class="search-form-item">
        <label class="label" for="ServantTypeID">신분</label>
        <select class="custom-select" id="ServantTypeID" name="ServantTypeID" onchange="submit()">
            <option selected>선택</option>
            @foreach ($ServantTypeList as $ServantType)
                <option @if(request('ServantTypeID') == $ServantType->ID ) selected @endif
                    value="{{ $ServantType->ID }}">{{ $ServantType->Item }}</option>
            @endforeach
        </select>
    </div> <!-- /.search-form-item -->
    @endif

    @if(isset($inputText))
    <div class="search-form-item">
        <label class="label" for="{{ $inputText['id'] }}">{{ $inputText['label'] }}</label>
        <input type="text" class="form-control" id="{{ $inputText['label'] }}" name="{{ $inputText['label'] }}" placeholder="입력해 주세요">
    </div> <!-- /.search-form-item -->
    @endif  

    @if(isset($inputDate))
    <div class="search-form-item">
        <label class="label" for="Start{{ $inputDate['id'] }}">{{ $inputDate['label'] }}</label>
        <div class="date-wrap">
            <div class="input-group">
                <input type="date" class="form-control" id="Start{{ $inputDate['id'] }}" name="Start{{ $inputDate['id'] }}" placeholder="시작 날자를 선택해 주세요">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="div">~</div>
            <div class="input-group">
                <input type="date" class="form-control" id="End{{ $inputDate['id'] }}" name="End{{ $inputDate['id'] }}" placeholder="마지막 날자를 선택해 주세요">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.search-form-item -->
    @endif

    <div class="search-btn-area">
        <button type="submit" class="btn btn-primary">조회</button>
    </div> <!-- /.search-btn-area -->

</section>