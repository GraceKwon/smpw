<form method="GET" id="frm">
    <section class="search-section">

        @if(isset($MetroList))
        <div class="search-form-item">
            <label class="label" for="MetroID">도시</label>
            <select class="custom-select" 
            {{-- @if(session('auth.MetroID')) disabled  @endif --}}
                id="MetroID" name="MetroID" 
                onchange="document.getElementById('CircuitID').value = '';
                    if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = ''; 
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = ''; 
                    submit()"
                    >
                <option value="">전체</option>
                @foreach ($MetroList as $Metro)
                    @if(!session('auth.MetroID') || session('auth.MetroID') ==  $Metro->MetroID)
                        <option @if(request()->MetroID == $Metro->MetroID ) selected @endif
                        value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
                    @endif
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @if(isset($CircuitList))
        <div class="search-form-item">
            <label class="label" for="CircuitID">지역</label>
            <select class="custom-select" 
                {{-- @if(session('auth.CircuitID')) disabled  @endif --}}
                id="CircuitID" name="CircuitID" 
                onchange="if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = ''; 
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = ''; 
                    submit()">
                <option value="">전체</option>
                @foreach ($CircuitList as $Circuit)
                    @if(!session('auth.CircuitID') || session('auth.CircuitID') == $Circuit->CircuitID)
                        <option @if(request()->CircuitID == $Circuit->CircuitID ) selected @endif
                        value="{{ $Circuit->CircuitID }}">{{ $Circuit->CircuitName }}</option>
                    @endif
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

        @stack('slot')
        <div class="search-btn-area">
            <button type="submit" class="btn btn-primary">조회</button>
        </div> <!-- /.search-btn-area -->

    </section>
</form>
