@extends('layouts.frames.master')
@section('content')
    <div class="search-form-item">
        <label class="label" for="CreateDate">{{ __('msg.CP') }} : </label>
        <strong> {{$month}} {{ __('msg.MONTH') }} </strong>
    </div> <!-- /.search-form-item -->

    <section class="section-table-section">
        <div class="table-responsive">
            <table class="table table-center table-font-size-90">
                <thead>
                <tr>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.NOP') }}({{ __('msg.BRO') }})</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.NOP') }}({{ __('msg.SIS') }})</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.NOPS') }}({{ __('msg.BRO') }})</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.NOPS') }}({{ __('msg.SIS') }})</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.TNOP') }}({{ __('msg.BRO') }})</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>{{ __('msg.TNOP') }}({{ __('msg.SIS') }})</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $StatisticList->MemberMaleCount }}
                        </td>
                        <td>
                            {{ $StatisticList->MemberFeMaleCount }}
                        </td>
                        <td>
                            {{ $StatisticList->RealMemberMaleCount }}
                        </td>
                        <td>
                            {{ $StatisticList->RealMemberFeMaleCount }}
                        </td>
                        <td>
                            {{ $StatisticList->TotalMemberMaleCount }}
                        </td>
                        <td>
                            {{ $StatisticList->TotalMemberFeMaleCount }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el:'#wrapper-body',
            mixins: [datepickerLang],
            data:{
                CreateDate: [
                    '{{ request()->StartDate }}',
                    '{{ request()->EndDate }}',
                ],
            },
            computed:{
                query: function () {
                    var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->CircuitID }}';
                    query += '&TypeID={{ request()->TypeID }}';
                    query += '&StartDate=' + this.CreateDate[0];
                    query += '&EndDate=' + this.CreateDate[1];
                    return query;
                }
            },
            methods:{
                _export:function () {
                    location.href = '/{{ request()->path() }}/export' + this.query;
                },
            }
        })
    </script>
@endsection
