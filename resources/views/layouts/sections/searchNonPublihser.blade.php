<form method="GET" id="frm">
    <section class="search-section">
        @if(isset($MetroList))
            <div class="search-form-item">
                <label class="label" for="MetroID">{{{ __('msg.CITY') }}}</label>
                <select class="custom-select"
                        @if(session('auth.MetroID')) disabled @endif
                        id="MetroID" name="MetroID"
                        onchange="if(document.getElementById('CircuitID') !== null) document.getElementById('CircuitID').value = '';
                    if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = '';
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = '';
                    submit()"
                >
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($MetroList as $Metro)
                        <option
                            @if(session('auth.MetroID') ==  $Metro->MetroID || request()->MetroID == $Metro->MetroID ) selected
                            @endif
                            value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
                    @endforeach
                </select>
            </div> <!-- /.search-form-item -->
        @endif

        @if(isset($CircuitList))
            <div class="search-form-item">
                <label class="label" for="CircuitID">{{ __('msg.AREA') }}</label>
                <select class="custom-select"
                        @if(session('auth.CircuitID')) disabled @endif
                        id="CircuitID" name="CircuitID"
                        onchange="if(document.getElementById('CongregationID') !== null) document.getElementById('CongregationID').value = '';
                    if(document.getElementById('ServiceZoneID') !== null) document.getElementById('ServiceZoneID').value = '';
                    submit()">
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($CircuitList as $Circuit)
                        <option
                            @if(session('auth.CircuitID') ==  $Circuit->CircuitID || request()->CircuitID == $Circuit->CircuitID ) selected
                            @endif
                            value="{{ $Circuit->CircuitID }}">{{ $Circuit->CircuitName }}</option>
                    @endforeach
                </select>
            </div> <!-- /.search-form-item -->
        @endif

        @if(isset($CongregationList))
            <div class="search-form-item">
                <label class="label" for="CongregationID">{{ __('msg.CGN') }}</label>
                <select class="custom-select" id="CongregationID" name="CongregationID" onchange=";submit()">
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($CongregationList as $Congregation)
                        <option @if(request()->CongregationID == $Congregation->CongregationID ) selected @endif
                        value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
                    @endforeach
                </select>
            </div> <!-- /.search-form-item -->
        @endif

        @if(isset($AdminRoleList))
            <div class="search-form-item">
                <label class="label" for="AdminRoleID">{{ __('msg.PER') }}</label>
                <select class="custom-select" id="AdminRoleID" name="AdminRoleID" onchange="submit()">
                    <option value="" selected>{{ __('msg.ALL') }}</option>
                    @foreach ($AdminRoleList as $AdminRole)
                        <option @if(request()->AdminRoleID == $AdminRole->ID ) selected @endif
                        value="{{ $AdminRole->ID }}">{{ $AdminRole->Item }}</option>
                    @endforeach
                </select>
            </div> <!-- /.search-form-item -->
        @endif

        @if(isset($ReceiveGroupList))
            <div class="search-form-item">
                <label class="label" for="ReceiveGroupID">{{ __('msg.TAR') }}</label>
                <select class="custom-select" id="ReceiveGroupID" name="ReceiveGroupID" onchange="submit()">
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($ReceiveGroupList as $ReceiveGroup)
                        <option @if(request()->ReceiveGroupID == $ReceiveGroup->ID ) selected @endif
                        value="{{ $ReceiveGroup->ID }}">{{ $ReceiveGroup->Item }}</option>
                    @endforeach
                </select>
            </div> <!-- /.search-form-item -->
        @endif

        @if(isset($AdminID))
            <div class="search-form-item">
                <label class="label" for="AdminID">{{ __('msg.SENDING') }}</label>
                <select class="custom-select"
                        id="AdminID"
                        name="AdminID"
                        onchange="submit()">
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($AdminID as $Admin)
                        <option
                            @if(request()->AdminID == $Admin->AdminID ) selected @endif
                        value="{{ $Admin->AdminID }}">
                            @if ($Admin->AdminRoleID == 3)
                                순회감독자 -
                            @endif
                            @if ($Admin->AdminRoleID == 4)
                                순회구보조자 -
                            @endif
                            @if ($Admin->AdminRoleID == 5)
                                조정장로 -
                            @endif
                            {{ $Admin->AdminName }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if(isset($ReceiveAdminID))
            <div class="search-form-item">
                <label class="label" for="ReceiveAdminID">{{ __('msg.RECEIVE') }}</label>
                <select class="custom-select" id="ReceiveAdminID" name="ReceiveAdminID" onchange="submit()">
                    <option value="">{{ __('msg.ALL') }}</option>
                    @foreach ($ReceiveAdminID as $Admin)
                        <option @if(request()->ReceiveAdminID == $Admin->AdminID ) selected @endif
                        value="{{ $Admin->AdminID }}">
                            @if ($Admin->AdminRoleID == 3)
                                순회감독자 -
                            @endif
                            @if ($Admin->AdminRoleID == 4)
                                순회구보조자 -
                            @endif
                            @if ($Admin->AdminRoleID == 5)
                                조정장로 -
                            @endif
                            {{ $Admin->AdminName }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if(isset($selectBoxs))
            @foreach ($selectBoxs as $selectBox)
                <div class="search-form-item">
                    <label class="label" for="Month">{{ $selectBox['label'] }}</label>
                    <select class="custom-select" id="{{ $selectBox['id'] }}" name="{{ $selectBox['id'] }}"
                            onchange="submit()">
                        @foreach ($selectBox['options'] as $option)
                            <option @if(request($selectBox['id']) === $option['value'] ) selected @endif
                            value="{{ $option['value']  }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div> <!-- /.search-form-item -->
            @endforeach
        @endif

        @stack('slot')

        <div class="search-btn-area">
            <button type="submit" class="btn btn-primary">{{ __('msg.SE') }}</button>
        </div> <!-- /.search-btn-area -->

    </section>
</form>
