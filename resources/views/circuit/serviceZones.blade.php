@extends('layouts.frames.master')
@section('content')
    <section class="section-table-section edit-circuits-territory-list">
        <div class="table-responsive">
            <table class="table table-center table-hover table-font-size-90">
                <thead>
                <tr>
                    <th>
                        <div class="min-width">
                            <span>우선 순위</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>구역 명칭</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>구역 약호</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>등록자</span>
                        </div>
                    </th>
                    <th>
                        <div class="min-width">
                            <span>등록 일자</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($ServiceZoneList as $ServiceZone)
                    <tr class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ServiceZone->ServiceZoneID }}'">
                        <td>
                            {{ $ServiceZone->OrderNum }}
                        </td>
                        <td>
                            {{ $ServiceZone->ZoneName }}
                        </td>
                        <td>
                            {{ $ServiceZone->ZoneAlias }}
                        </td>
                        <td>
                            {{ $ServiceZone->AdminName }}
                        </td>
                        <td>
                            {{ $ServiceZone->CreateDate }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('auth.CircuitID'))
        <div class="btn-flex-area justify-content-end mt-3">
            <button type="button" class="btn btn-primary" onclick="location.href = '/{{request()->path()}}/0'">구역 등록</button>
        </div>
        @endif
        <!--start pagination -->
        <div>
            {{-- {{ $ZoneList->links() }} --}}
        </div>
        <!-- end pagination -->
        

    </section>
@endsection

@section('popup')
    <!-- <section class="modal-layer-container">
        <div class="mx-auto px-3">
            <div class="mlp-wrap">
                <div class="max-w-800px">
                    <div class="mlp-header">
                        <div class="mlp-title">
                            <span>Modal layer popup</span>
                        </div>
                        <div class="mlp-close">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="mlp-content">
                        점검중입니다
                    </div>
                    <div class="mlp-footer justify-content-end">
                        <button class="btn btn-secondary btn-sm">취소</button>
                        <button class="btn btn-primary btn-sm">확인</button>
                    </div>
                </div>
            </div> 
        </div>
    </section> -->
@endsection

{{-- @section('script')
<script>
</script>
@endsection --}}
