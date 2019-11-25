<form method="GET" id="frm">
    <section class="search-section">

        @if(isset($MetroList))
        <div class="search-form-item">
            <label class="label" for="MetroID">도시</label>
            <select class="custom-select" 
                @if(session('auth.MetroID')) disabled  @endif
                id="MetroID" name="MetroID" 
                onchange="document.getElementById('CircuitID').value = '';
                    if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = ''; 
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = ''; 
                    submit()"
                    >
                <option value="">전체</option>
                @foreach ($MetroList as $Metro)
                    <option @if(session('auth.MetroID') ==  $Metro->MetroID || request()->MetroID == $Metro->MetroID ) selected @endif
                    value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($CircuitList))
        <div class="search-form-item">
            <label class="label" for="CircuitID">지역</label>
            <select class="custom-select" 
                @if(session('auth.MetroID')) disabled  @endif
                id="CircuitID" name="CircuitID" 
                onchange="if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = ''; 
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = ''; 
                    submit()">
                <option value="">전체</option>
                @foreach ($CircuitList as $Circuit)
                    <option @if(session('auth.CircuitID') ==  $Circuit->CircuitID || request()->CircuitID == $Circuit->CircuitID ) selected @endif
                    value="{{ $Circuit->CircuitID }}">{{ $Circuit->CircuitName }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($CongregationList))
        <div class="search-form-item">
            <label class="label" for="CongregationID">회중</label>
            <select class="custom-select" id="CongregationID" name="CongregationID" onchange=";submit()">
                <option value="">전체</option>
                @foreach ($CongregationList as $Congregation)
                    <option @if(request()->CongregationID == $Congregation->CongregationID ) selected @endif
                    value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($ServiceZoneList))
        <div class="search-form-item">
            <label class="label" for="ServiceZoneID">구역</label>
            <select class="custom-select" id="ServiceZoneID" name="ServiceZoneID" onchange="submit()">
                <option value="">전체</option>
                @foreach ($ServiceZoneList as $ServiceZone)
                    <option @if(request()->ServiceZoneID == $ServiceZone->ServiceZoneID ) selected @endif
                    value="{{ $ServiceZone->ServiceZoneID }}">{{ $ServiceZone->ZoneName }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($AdminRoleList))
        <div class="search-form-item">
            <label class="label" for="AdminRoleID">권한</label>
            <select class="custom-select" id="AdminRoleID" name="AdminRoleID" onchange="submit()">
                <option value="" selected>전체</option>
                @foreach ($AdminRoleList as $AdminRole)
                    <option @if(request()->AdminRoleID == $AdminRole->ID ) selected @endif
                        value="{{ $AdminRole->ID }}">{{ $AdminRole->Item }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($ServantTypeList))
        <div class="search-form-item">
            <label class="label" for="ServantTypeID">신분</label>
            <select class="custom-select" id="ServantTypeID" name="ServantTypeID" onchange="submit()">
                <option value="">전체</option>
                @foreach ($ServantTypeList as $ServantType)
                    <option @if(request()->ServantTypeID == $ServantType->ID ) selected @endif
                        value="{{ $ServantType->ID }}">{{ $ServantType->Item }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($ReceiveGroupList))
        <div class="search-form-item">
            <label class="label" for="ReceiveGroupID">대상</label>
            <select class="custom-select" id="ReceiveGroupID" name="ReceiveGroupID" onchange="submit()">
                <option value="">전체</option>
                @foreach ($ReceiveGroupList as $ReceiveGroup)
                    <option @if(request()->ReceiveGroupID == $ReceiveGroup->ID ) selected @endif
                        value="{{ $ReceiveGroup->ID }}">{{ $ReceiveGroup->Item }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($selectBoxs))
            @foreach ($selectBoxs as $selectBox)
                <div class="search-form-item">
                    <label class="label" for="ServantTypeID">{{ $selectBox['label'] }}</label>
                    <select class="custom-select" id="{{ $selectBox['id'] }}" name="{{ $selectBox['id'] }}" onchange="submit()">
                        <option value="">전체</option>
                        @foreach ($selectBox['options'] as $option)
                            <option @if(request($selectBox['id']) == $option['value'] ) selected @endif
                                value="{{ $option['value']  }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div> <!-- /.search-form-item -->
            @endforeach
        @endif

        @if(isset($inputTexts))
            @foreach ($inputTexts as $inputText)
                <div class="search-form-item">
                    <label class="label" for="{{ $inputText['id'] }}">{{ $inputText['label'] }}</label>
                    <input type="text" class="form-control" id="{{ $inputText['id'] }}" name="{{ $inputText['id'] }}" value="{{ request($inputText['id']) }}" placeholder="입력해 주세요">
                </div> <!-- /.search-form-item -->
            @endforeach
        @endif  

        @if(isset($inputDate))
        <div class="search-form-item">
            <label class="label" for="Start{{ $inputDate['id'] }}">{{ $inputDate['label'] }}</label>
            <div class="date-wrap">
                <div class="input-group">
                    <input type="date" class="form-control" id="{{ 'Start' . $inputDate['id'] }}" name="{{ 'Start' . $inputDate['id'] }}" value="{{ request('Start'.$inputDate['id']) }}" placeholder="시작 날자를 전체해 주세요">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="div">~</div>
                <div class="input-group">
                    <input type="date" class="form-control" id="{{ 'End' . $inputDate['id'] }}" name="{{ 'End' . $inputDate['id'] }}" value="{{ request('End'.$inputDate['id']) }}" placeholder="마지막 날자를 전체해 주세요">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.search-form-item -->
        @endif

        @stack('slot')
        <div class="search-btn-area">
            <button type="submit" class="btn btn-primary">조회</button>
        </div> <!-- /.search-btn-area -->

    </section>
</form>
