@extends('layouts.app')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('header')
Maklumat Pemohon
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
<li class="breadcrumb-item"><a>Maklumat Pemohon</a></li>
@endsection

@section('content')
<style>

</style>
<div class="row">
    <div class="col-md-4 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="fw-bolder">Maklumat Pemohon</h4>
            </div>

            <hr>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 mb-1">
                        <label class="fw-bolder">Nama Pemohon</label>
                        <textarea type="text" class="form-control" rows="4" id="" disabled></textarea>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-12 mb-1">
                        <label class="fw-bolder">No Kad Pengenalan</label>
                        <input type="text" class="form-control" name="" id="" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 col-xl-8">
        <ul class="nav nav-pills nav-justified" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder active" id="peribadi-tab" data-bs-toggle="tab" href="#peribadi" aria-controls="peribadi" role="tab" aria-selected="true">
                    Maklumat Peribadi
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder" id="skim-tab" data-bs-toggle="tab" href="#skim" aria-controls="skim" role="tab" aria-selected="true">
                    Maklumat Skim
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder" id="akademik-tab" data-bs-toggle="tab" href="#akademik" aria-controls="akademik" role="tab" aria-selected="true">
                    Maklumat Akademik
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder" id="perkhidmatan-tab" data-bs-toggle="tab" href="#perkhidmatan" aria-controls="perkhidmatan" role="tab" aria-selected="true">
                    Perkhidmatan Pegawai
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder" id="tambahan-tab" data-bs-toggle="tab" href="#tambahan" aria-controls="tambahan" role="tab" aria-selected="true">
                    Maklumat Tambahan
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link fw-bolder" id="tatatertib-tab" data-bs-toggle="tab" href="#tatatertib" aria-controls="tatatertib" role="tab" aria-selected="true">
                    Tatatertib
                </a>
            </li>
        </ul>

        <div class="tab-content bukanKptContent">
            <div class="tab-pane fade show active" id="peribadi" role="tabpanel" aria-labelledby="peribadi-tab">
                @include('maklumat_pemohon.pemohon.maklumat_peribadi')
            </div>
            <div class="tab-pane fade" id="skim" role="tabpanel" aria-labelledby="skim-tab">
                @include('maklumat_pemohon.pemohon.maklumat_skim')
            </div>
            <div class="tab-pane fade" id="akademik" role="tabpanel" aria-labelledby="akademik-tab">
                @include('maklumat_pemohon.pemohon.maklumat_akademik')
            </div>
            <div class="tab-pane fade" id="perkhidmatan" role="tabpanel" aria-labelledby="perkhidmatan-tab">
                @include('maklumat_pemohon.pemohon.perkhidmatan')
            </div>
            <div class="tab-pane fade" id="tambahan" role="tabpanel" aria-labelledby="tambahan-tab">
                @include('maklumat_pemohon.pemohon.maklumat_tambahan')
            </div>
            <div class="tab-pane fade" id="tatatertib" role="tabpanel" aria-labelledby="tatatertib-tab">
                @include('maklumat_pemohon.pemohon.tatatertib')
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection