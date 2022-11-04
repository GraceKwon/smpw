@extends('layouts.frames.master')
@section('content')

    <section class="section-table-section">
        <div class="table-responsive">
            <table class="table table-center table-font-size-90">
                <thead>
                <tr>
                    <th>
                        <div class="min-width">
                            <span>인원(형제)</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>인원(자매)</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>참여자수(형제)</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>참여자수(자매)</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>총참여횟수(형제)</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>총참여횟수(자매)</span>
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
