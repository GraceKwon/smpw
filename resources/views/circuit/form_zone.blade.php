@extends('layouts.frames.master')

@section('content')
    <section class="section-register-wrap">
        <div class="register-form-item">
            <label class="label" for="register01">우선 순위</label>
            <div class="register-form-container inline-responsive">
                <select class="custom-select" id="register01">
                    <option selected>선택해 주세요</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register02">구역 약호</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register02" placeholder="구역 약호를 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register03">구역 명칭</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register03" placeholder="구역 명칭을 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register04">위도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register04" placeholder="위도를 입력해 주세요">
            </div>
        </div> <!-- /.search-form-item -->
        <div class="register-form-item">
            <label class="label" for="register05">경도</label>
            <div class="register-form-container inline-responsive">
                <input type="text" class="form-control min-w-300px-desktop" id="register05" placeholder="경도를 입력해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label">지도에서 선택</label>
            <div class="register-form-container">
                <div class="register-map">
                    <div class="p-3 text-muted font-size-80">
                        지도 api를 삽입해 주세요
                    </div>
                </div>
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-form-item">
            <label class="label" for="register06">구역 주소</label>
            <div class="register-form-container">
                <input type="text" class="form-control" id="register06" placeholder="지도에서 구역을 선택해 주세요">
            </div>
        </div> <!-- /.register-form-item -->
        <div class="register-btn-area">
            <button type="button" class="btn btn-secondary btn-responsive">취소</button>
            <button type="button" class="btn btn-primary btn-responsive">저장</button>
        </div> <!-- /.register-btn-area -->
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