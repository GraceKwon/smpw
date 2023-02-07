@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    @error('fail')
        <div class="alert alert-danger">{!! $message !!}</div>
    @enderror
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST"
    @submit="_confirm"
    @keydown.enter.prevent>
    @method("PUT")
    @csrf
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label" for="Account">{{ __('msg.ID') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text"
                        class="form-control"
                        id="Account"
                        name="Account"
                        v-model="Account"
                        placeholder="{{ __('msg.CREATE_AUTO') }}"
                        disabled>
                </div>
            </td>
            <th rowspan="{{ 5 + ( isset($Publisher->PublisherID) ? 1 : 0 ) }}">
                <label class="label">사진</label>
            </th>
            <td rowspan="{{ 5 + ( isset($Publisher->PublisherID) ? 1 : 0 ) }}">
                <div class="photo-container">
                    <div class="photo-wrap">
                        @if($Publisher && $Publisher->PhotoFilePath)
                            <img :src="'{{env('PROFILE_PHOTO').$Publisher->PhotoFilePath}}'" class="thumbnail">
                        @else
                            <img :src="'../img/demo/demo-profile-thumbnail.png'" class="thumbnail">
                        @endif
                        <input type="hidden" name="PhotoFilePath" v-model="PhotoFilePath">
                    </div>
                </div>
            </td>
        </tr>
        @if(isset($Publisher->PublisherID))
        <tr>
            <th>
                <label class="label" for="register02">{{ __('msg.PWS') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <button type="button" class="btn btn-primary"
                        @click="_resetPwd">{{ __('msg.PWS') }}</button>
                </div>
            </td>
        </tr>
        @endif
        <tr>
            <th>
                <label class="label" for="PublisherName">{{ __('msg.NAME') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text"
                        class="form-control @error('PublisherName') is-invalid @enderror"
                        id="PublisherName"
                        name="PublisherName"
                        v-model="PublisherName"
                        placeholder="{{ __('msg.ENTER_UR_NAME') }}">
                        @error('PublisherName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="CongregationID">{{ __('msg.CGN') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('CongregationID') is-invalid @enderror"
                        id="CongregationID"
                        v-model="CongregationID"
                        name="CongregationID">
                        <option value="">{{ __('msg.SELECT') }}</option>
                        @foreach ($CongregationList as $Congregation)
                            <option value="{{ $Congregation->CongregationID }}">{{ $Congregation->CongregationName }}</option>
                        @endforeach
                    </select>
                    @error('CongregationID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.GENDER') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input @error('Gender') is-invalid @enderror"
                            id="M"
                            value="M"
                            v-model="Gender"
                            name="Gender">
                        <label class="custom-control-label" for="M">{{ __('msg.BRO') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input @error('Gender') is-invalid @enderror"
                            id="F"
                            value="F"
                            v-model="Gender"
                            name="Gender">
                        <label class="custom-control-label" for="F">{{ __('msg.SIS') }}</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="Mobile">{{ __('msg.TEL') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text"
                        class="form-control @error('Mobile') is-invalid @enderror"
                        id="Mobile"
                        name="Mobile"
                        v-model="Mobile"
                        placeholder="{{ __('msg.ENTER_UR_CONTACT_INFO') }}">
                    @error('Mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register05">{{ __('msg.PUB_STATUS') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('ServantTypeID') is-invalid @enderror"
                        id="ServantTypeID"
                        name="ServantTypeID"
                        v-model="ServantTypeID">
                        <option value="">{{ __('msg.SELECT') }}</option>
                        @foreach ($ServantTypeList as $ServantType)
                            <option value="{{ $ServantType->ID }}">{{ $ServantType->Item }}</option>
                        @endforeach
                    </select>
                    @error('ServantTypeID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
            <th>
                <label class="label" for="PioneerTypeID">{{ __('msg.PUB_PRI') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('PioneerTypeID') is-invalid @enderror"
                        id="PioneerTypeID"
                        name="PioneerTypeID"
                        v-model="PioneerTypeID">
                        <option value="">{{ __('msg.SELECT') }}</option>
                        @foreach ($PioneerTypeList as $PioneerType)
                            <option value="{{ $PioneerType->ID }}">{{ $PioneerType->Item }}</option>
                        @endforeach
                    </select>
                    @error('PioneerTypeID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.SERVICE_STATUS') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input"
                            v-model="StopYn"
                            id="StopN"
                            name="StopYn"
                            value="1"
                            name="StopYn">
                        <label class="custom-control-label" for="StopN">{{ __('msg.IS') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input"
                            v-model="StopYn"
                            id="StopY"
                            name="StopYn"
                            value="0"
                            name="StopYn">
                        <label class="custom-control-label" for="StopY">{{ __('msg.SS') }}</label>
                    </div>
                </div>
            </td>
            <th>
                <label class="label">{{ __('msg.SUPPORT_AVAIL') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="check-group inline-responsive">
                        <div class="custom-control custom-radio">
                            <input type="radio"
                                class="custom-control-input @error('SupportYn') is-invalid @enderror"
                                v-model="SupportYn"
                                id="SupportY"
                                value="1"
                                name="SupportYn">
                            <label class="custom-control-label" for="SupportY">{{ __('msg.PO') }}</label>
                        </div>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input @error('SupportYn') is-invalid @enderror"
                            v-model="SupportYn"
                            id="SupportN"
                            value="0"
                            name="SupportYn">
                        <label class="custom-control-label" for="SupportN">{{ __('msg.IMP') }}</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="register07">{{ __('msg.MEMO') }}</label>
            </th>
            <td colspan="3">
                <div class="inline-responsive">
                    <textarea type="text"
                        class="form-control w-100 @error('Memo') is-invalid @enderror"
                        id="Memo"
                        name="Memo"
                        {{-- v-model="Memo" --}}
                        rows="5"
                        placeholder="{{ __('msg.ENTER_MEMO') }}">{{ old('Memo') ?? $Publisher->Memo  ?? '' }}</textarea>
                        @error('Memo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label" for="EndDate">{{ __('msg.ACCOUNT_DEL_DATE') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <div class="input-group max-w-250px-desktop">
                        <input type="date"
                            class="form-control @error('EndDate') is-invalid @enderror"
                            id="EndDate"
                            name="EndDate"
                            v-model="EndDate"
                            :disabled="StopYn === '0'"
                            placeholder="{{ __('msg.PSTD') }}">
                        @error('EndDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </td>
            <th>
                <label class="label" for="register09">{{ __('msg.RES_ACCOUNT_DEL') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('EndTypeID') is-invalid @enderror"
                        id="EndTypeID"
                        name="EndTypeID"
                        :disabled="StopYn === '0'"
                        v-model="EndTypeID">
                        <option value="">{{ __('msg.SELECT') }}</option>
                        @foreach ($EndTypeIDList as $EndTypeID)
                            <option value="{{ $EndTypeID->ID }}">{{ $EndTypeID->Item }}</option>
                        @endforeach
                    </select>
                    @error('EndTypeID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    @include('layouts.sections.formButton', [
            'id' => isset($Publisher->PublisherID),
        ])
    </form>
    <form ref="formDelete" method="POST">
        @method("DELETE")
        @csrf
    </form>
    <form ref="formResetPwd" method="POST">
        @csrf
        <input type="hidden" name="Account" v-model="Account" />
        <input type="hidden" name="Mobile" v-model="Mobile" />
    </form>
</section>

@if(isset($ServiceTimeList) && isset($Publisher->PublisherID))
<section class="table-section mt-6">
    <h4 class="text-primary">{{ __('msg.SERVICE_TIME_SELECT') }}</h4>
    <div class="inline-responsive">
        <form method="get">
            <select class="custom-select"
                onchange="submit()"
                name="ServiceYoil"
                v-model="ServiceYoil">
                <option value="{{ __('msg.MO') }}">{{ __('msg.MO') }}</option>
                <option value="{{ __('msg.TU') }}">{{ __('msg.TU') }}</option>
                <option value="{{ __('msg.WE') }}">{{ __('msg.WE') }}</option>
                <option value="{{ __('msg.TH') }}">{{ __('msg.TH') }}</option>
                <option value="{{ __('msg.FR') }}">{{ __('msg.FR') }}</option>
                <option value="{{ __('msg.SA') }}">{{ __('msg.SA') }}</option>
                <option value="{{ __('msg.SU') }}">{{ __('msg.SU') }}</option>
            </select>
        </form>
        {{-- <div class="btn-flex-area"> --}}

        @foreach ($SetTimeCount as $week => $count)
        <a href="?ServiceYoil={{ $week }}">
            <span class="badge badge-secondary mt-1 mt-sm-0 ml-sm-2">
                {{ $week }}
                <span class="badge badge-pill badge-warning">
                    {{ $count }}
                </span>
            </span>
        </a>
        {{-- {{ $week }} ({{ $count }}), --}}
        {{-- <button class="btn
            @if(request('ServiceYoil') === $week || !request('ServiceYoil') && $week === '월') btn-primary @else btn-secondary @endif
            mt-1 mt-sm-0 ml-sm-2 min-w-100px-desktop "
            onclick="location.href='?ServiceYoil={{ $week }}'">
            {{ $week }}
            @if(isset($SetTimeCount[$week]))
                <span class="badge badge-light">{{ $SetTimeCount[$week] }}</span>
            @endif
        </button> --}}
        @endforeach
        {{-- </div> --}}
    </div>
    <form method="POST"
    @keydown.enter.prevent>
    @method("PATCH")
    @csrf
        <div class="table-area table-responsive mt-2">
            <table class="table table-bordered table-center font-size-90">
                <thead>
                <tr>
                    <th>
                        <label class="label">{{ __('msg.ST') }} </label>
                    </th>
                    @foreach ($ServiceZoneList as $ServiceZone)
                    <th>
                        <div class="min-w-100px">
                        <label class="label">{{ $ServiceZone->ZoneName }}   </label>
                        </div>
                    </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach ($ServiceTimeList as $time => $ServiceTimes)
                    <tr>
                        <th>
                            <label class="label">{{ sprintfServiceTime($time) }}</label>
                        </th>
                        @foreach ($ServiceTimes as $ServiceTime)
                        <td @if( empty($ServiceTime) )
                            @elseif( $ServiceTime['ServiceSetType'] === '대기' )
                                class="state-publisher-wait"
                            @elseif( $ServiceTime['ServiceSetType'] === '봉사자' )
                                class="state-publisher-set"
                            @elseif( $ServiceTime['ServiceSetType'] === '인도자' )
                                class="state-publisher-leader"
                            @endif>
                        @if( !empty($ServiceTime) )
                            <div class="form-inline">
                                <select class="custom-select mx-auto"
                                    name="ServiceSetType[{{ $ServiceTime['ServiceTimeID'] }}]">
                                    <option value="미지정" @if( $ServiceTime['ServiceSetType'] === '미지정' ) selected @endif>
                                        {{ __('msg.UNS') }}
                                    </option>
                                    @if($ServiceTime['PublisherCnt'] < session('auth.PublisherNumber') )
                                        <option value="대기" @if( $ServiceTime['ServiceSetType'] === '대기' ) selected @endif>
                                            {{ __('msg.W') }}</option>
                                        <option value="봉사자" @if( $ServiceTime['ServiceSetType'] === '봉사자' ) selected @endif>
                                            {{ __('msg.PUB') }}</option>
                                        @if($ServiceTime['ServiceSetType'] === '인도자' || $ServiceTime['LeaderCnt'] < 1)
                                            <option value="인도자" @if( $ServiceTime['ServiceSetType'] === '인도자' ) selected @endif>
                                                {{ __('msg.CON') }}</option>
                                        @endif
                                    @elseif($ServiceTime['ServiceSetType'] !== '미지정')
                                        <option value="{{ $ServiceTime['ServiceSetType'] }}" selected>{{ $ServiceTime['ServiceSetType'] }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mt-1 font-size-80">[{{ $ServiceTime['PublisherCnt'] }}/{{ session('auth.PublisherNumber') }}]</div>
                        </td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-inline align-items-center mt-3">
            <div class="min-w-140px text-primary">{{ __('msg.START_CHANGE_SCH') }}</div>
            <div class="input-group mt-2 mt-md-0">
                <input type="date" class="form-control @error('SetStartDate') is-invalid @enderror"
                    name="SetStartDate"
                    v-model="SetStartDate"
                    placeholder="{{ __('msg.PSTD') }}">
                @error('SetStartDate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                {{-- <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div> --}}
            </div>
            <button class="btn btn-primary mt-2 mt-md-0 ml-md-2">{{ __('msg.SC') }}</button>
        </div>
    </form>
</section>
@endif
@endsection

@section('script')
<script>
    const locale = '{{ $location }}';

    var app = new Vue({
        el:'#wrapper-body',
        data:{
            Account: "{{ $Publisher->Account ?? '' }}",
            PublisherName: "{{ old('PublisherName') ?? $Publisher->PublisherName ?? '' }}",
            CongregationID: "{{ old('CongregationID') ?? $Publisher->CongregationID ?? '' }}",
            Gender: "{{ old('Gender') ?? $Publisher->Gender ?? 'M' }}",
            Mobile: "{{ old('Mobile') ?? $Publisher->Mobile ?? '' }}",
            MobileOsKindID: "{{ old('MobileOsKindID') ?? $Publisher->MobileOsKindID ?? '' }}",
            PhotoFilePath: "{{ old('PhotoFilePath') ?? $Publisher->PhotoFilePath ?? '' }}",
            PioneerTypeID: "{{ old('PioneerTypeID') ?? $Publisher->PioneerTypeID ?? '' }}",
            ServantTypeID: "{{ old('ServantTypeID') ?? $Publisher->ServantTypeID ?? '' }}",
            StopYn: "{{ old('StopYn') ?? $Publisher->UseYn ?? '1' }}",
            SupportYn: "{{ old('SupportYn') ?? $Publisher->SupportYn ?? '1' }}",
            // Memo: "",
            EndDate: "{{ old('EndDate') ?? $Publisher->EndDate ?? '' }}",
            EndTypeID: "{{ old('EndTypeID') ?? $Publisher->EndTypeID ?? '' }}",
            ServiceYoil: "{{ request('ServiceYoil') ?? __('msg.MO') }}",
            ServiceSetType: "{{ request('ServiceYoil') ?? __('msg.MO') }}",
            SetStartDate: "{{ date('Y-m-d') }}",
        },
        watch: {
            Mobile: function () {
                if (locale === 'ko') {
                    this.Mobile = this.Mobile.replace(/[^0-9]/g, '');
                    this.Mobile = this.Mobile.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3")
                }
            },
        },
        methods:{
            _confirm: function (e) {
                var res = confirm('{{ isset($ServiceZone->ServiceZoneID) ? '수정' : '저장' }} ?');
                if(!res){
                    e.preventDefault();
                }

            },
            _delete: function () {
                if( confirm('{{ __('msg.WISH_DELETE') }}') ) this.$refs.formDelete.submit()
            },
            _resetPwd: function () {
                if( confirm('{{ __('msg.WANT_RESET_PW') }}') ) this.$refs.formResetPwd.submit()
            }
        }
    })

</script>
@endsection
