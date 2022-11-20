@extends('layouts.frames.master')
@section('content')
<div class="row row-10px">
    <div class="col-lg-12">
        <section class="section">
            <div class="shadow mb-4 p-5">
                <div class="d-sm-flex align-items-center">
                    <h3 class="text-primary mr-2">
                        {{ __('msg.PS') }}
                    </h3>
                    <div class="text-muted font-size-80">
                        (2019년 08월 기준)
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 col-lg-5">
                        <div class="bubble-graph bubble-graph-lg">
                            <div>
                                <label class="label">{{ __('msg.TOTAL') }}</label>
                                <div class="num">{{ $StatisticsCnt->PublisherCnt }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-7">
                        <div class="row">
                            <div class="col">
                                <div class="bubble-graph">
                                    <div>
                                        <label class="label">{{ __('msg.RP') }}</label>
                                        <div class="num">{{ $StatisticsCnt->Month1_Cnt }}</div>
                                        {{-- <div class="percent">91.25%</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="bubble-graph">
                                    <div>
                                        <label class="label">{{ __('msg.PWM6') }}</label>
                                        <div class="num">{{ $StatisticsCnt->Month6_Cnt }}</div>
                                        {{-- <div class="percent">91.25%</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="bubble-graph">
                                    <div>
                                        <label class="label">{{ __('msg.PWY1') }}</label>
                                        <div class="num">{{ $StatisticsCnt->Month12_Cnt }}</div>
                                        {{-- <div class="percent">91.25%</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="bubble-graph">
                                    <div>
                                        <label class="label">{{ __('msg.LTNP') }}</label>
                                        <div class="num">{{ $StatisticsCnt->Month12NO_Cnt }}</div>
                                        {{-- <div class="percent">91.25%</div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- <div class="col-lg-4">
        <section class="section">
            <div class="shadow mb-4 p-5">
                <div class="d-sm-flex align-items-center">
                    <h3 class="text-primary">
                        봉사보고 현황
                    </h3>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="w-100 h-250px">
                            그래프 넣어주세요.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> --}}
</div>
<div class="row row-10px">
    <div class="col-lg-3">
        <section class="section">
            <div class="shadow min-h-350px mb-4 p-5">
                <div class="d-sm-flex align-items-center">
                    <h3 class="text-primary">
                        {{ __('msg.VRS') }}
                    </h3>
                </div>
                <div class="content-area mt-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab01" data-toggle="tab" href="#panel01">{{ __('msg.THIS MONTH') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab02" data-toggle="tab" href="#panel02">{{ __('msg.YEAR') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab03" data-toggle="tab" href="#panel03">{{ __('msg.AS') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="panel01" aria-labelledby="tab01">
                            <div class="font-size-80">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th class="pl-0">
                                            <span>{{ __('msg.TOTAL PUB') }}</span>
                                        </th>
                                        <td class="text-right pr-0">
                                            <span>{{ $MainActCntTypeID1->PublisherCnt }}</span>
                                            <small>{{ __('msg.P') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0">
                                            <span>{{ __('msg.NEW PUB') }}</span>
                                        </th>
                                        <td class="text-right pr-0">
                                            <span>{{ $MainActCntTypeID1->NewPublisherCnt }}</span>
                                            <small>{{ __('msg.P') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0">
                                            <span>{{ __('msg.COUNT MAGAZINE') }}</span>
                                        </th>
                                        <td class="text-right pr-0">
                                            <span>{{ $MainActCntTypeID1->ProductCnt }}</span>
                                            <small>{{ __('msg.COPIES') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0">
                                            <span>{{ __('msg.SHOW VIDEO') }}</span>
                                        </th>
                                        <td class="text-right pr-0">
                                            <span>{{ $MainActCntTypeID1->VideoCnt }}</span>
                                            <small>{{ __('msg.COUNT SHOW VIDEO') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0">
                                            <span>{{ __('msg.VR') }}</span>
                                        </th>
                                        <td class="text-right pr-0">
                                            <span>{{ $MainActCntTypeID1->VisitCnt }}</span>
                                            <small>{{ __('msg.COUNT VISIT REQUEST') }}</small>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="panel02" aria-labelledby="tab02">
                            <div class="font-size-80">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.TOTAL PUB') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID2->PublisherCnt }}</span>
                                                <small>{{ __('msg.P') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.NEW PUB') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID2->NewPublisherCnt }}</span>
                                                <small>{{ __('msg.P') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.COUNT MAGAZINE') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID2->ProductCnt }}</span>
                                                <small>{{ __('msg.COPIES') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.SHOW VIDEO') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID2->VideoCnt }}</span>
                                                <small>{{ __('msg.COUNT SHOW VIDEO') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.VR') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID2->VisitCnt }}</span>
                                                <small>{{ __('msg.COUNT VISIT REQUEST') }}</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="panel03" aria-labelledby="tab03">
                            <div class="font-size-80">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.TOTAL PUB') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID3->PublisherCnt }}</span>
                                                <small>{{ __('msg.P') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.NEW PUB') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID3->NewPublisherCnt }}</span>
                                                <small>{{ __('msg.P') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.COUNT MAGAZINE') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID3->ProductCnt }}</span>
                                                <small>{{ __('msg.COPIES') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.SHOW VIDEO') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID3->VideoCnt }}</span>
                                                <small>{{ __('msg.COUNT SHOW VIDEO') }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0">
                                                <span>{{ __('msg.VR') }}</span>
                                            </th>
                                            <td class="text-right pr-0">
                                                <span>{{ $MainActCntTypeID3->VisitCnt }}</span>
                                                <small>{{ __('msg.COUNT VISIT REQUEST') }}</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="section">
            <div class="shadow min-h-350px mb-4 p-5">
                <div class="d-sm-flex align-items-center">
                    <h3 class="text-primary">
                        {{ __('msg.NOTICE') }}
                    </h3>
                </div>
                <div class="content-area">
                    <div class="font-size-80 mb-2 text-right">
                        <a href="/notices">
                            <span class="badge badge-secondary">+ {{ __('msg.SEE MORE') }}</span>
                        </a>
                    </div>
                    <div class="table-area">
                        <table class="table">
                            @foreach ($Notices as $Notice)
                            <tr>
                                <td class="pl-0">
                                    <a href="/notices/{{ $Notice->NoticeID }}">
                                        {{ $Notice->Title }}
                                    </a>
                                </td>
                                <td class="text-right text-muted pr-0">
                                    {{ $Notice->CreateDate }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <section class="main-icon-link">
            <div class="shadow min-h-350px mb-4">
                <a href="/publishers">
                    <i class="fas fa-users"></i>
                    <span>{{ __('msg.PM') }}</span>
                </a>
                @if(session('auth.MetroID') === 1)
                    @if(session('auth.AdminRoleID') === 5)
                        <a href="/publishers/0">
                            <i class="fas fa-user"></i>
                            <span>{{ __('msg.NPW') }}</span>
                        </a>
                    @endif
                @else
                    @if(session('auth.CircuitID'))
                        <a href="/publishers/0">
                            <i class="fas fa-user"></i>
                            <span>{{ __('msg.NPW') }}</span>
                        </a>
                    @endif
                @endif
                <a href="/reports">
                    <i class="fas fa-file-signature"></i>
                    <span>{{ __('msg.SRM') }}</span>
                </a>
                <a href="/inbox">
                    <i class="fas fa-envelope"></i>
                    <span>{{ __('msg.INBOX') }}</span>
                    {{-- <span class="badge badge-danger">2</span> --}}
                </a>
            </div>
        </section>
    </div>
</div>
@endsection

@section('popup')
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
