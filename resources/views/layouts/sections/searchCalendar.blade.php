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
                    submit()"
                    >
                {{-- <option value="">선택</option> --}}
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
                    submit()">
                <option value="">선택</option>
                @foreach ($CircuitList as $Circuit)
                    <option @if(session('auth.CircuitID') ==  $Circuit->CircuitID || request()->CircuitID == $Circuit->CircuitID ) selected @endif
                    value="{{ $Circuit->CircuitID }}">{{ $Circuit->CircuitName }}</option>
                @endforeach
            </select>
        </div> <!-- /.search-form-item -->
        @endif

        @stack('slot')

    </section>
</form>
