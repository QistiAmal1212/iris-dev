@extends('layouts.app')

@section('header')
Maklumat Pemohon
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="#"> Maklumat Pemohon </a></li>
@endsection

@section('content')
<section id="faq-search-filter">
    <div class="card faq-search" style="background-image: url('{{asset('images/banner/banner.png')}}')">
        <div class="card-body text-center">
            <h2 class="text-primary">Carian Maklumat Pemohon</h2>
            <p class="card-text mb-2">Isikan no. kad pengenalan calon dan tekan butang Cari</p>

            <form class="faq-search-input"> {{-- PLEASE DON'T CHANGE THE FORM CLASS --}}
                <div class="input-group input-group-merge">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>

                    {{-- Search form --}}
                    <input type="text" class="form-control" placeholder="No. Kad Pegenalan Calon" />
                    <button class="btn btn-primary waves-effect" type="button">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<hr>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 order-2 order-lg-1">
        <div class="card">
            <div class="card-body">
                <p class="card-title fw-bolder">Maklumat Permohonan</p>
                <hr>

                {{-- Maklumat Pemohon [Nama dan No KP] --}}
                <div class="mt-2">
                    <h5 class="fw-bolder">Nama Pemohon:</h5>
                    <p class="card-text">
                        Princess Aura Nurr Ermily Amara Auliya Bidadari Nawal El Zendra binti Mohd Suffian {{-- NAMA PEMOHON --}}
                    </p>
                </div>
                <div class="mt-2">
                    <h5 class="fw-bolder">No Kad Pengenalan:</h5>
                    <p class="card-text">
                        990701010011 {{-- IC PEMOHON --}}
                    </p>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-title fw-bolder">Garis Masa Permohonan</p>
                <hr>

                {{-- TIMELINE PERMOHONAN --}}
                <ul class="timeline mt-2">
                    {{-- This is where looping started if needed --}}
                    <li class="timeline-item">
                        <span class="timeline-point timeline-point-indicator"></span>
                        <div class="timeline-event">
                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                <h6>Permohonan Dikemaskini</h6> {{-- Timeline Activity --}}
                                <span class="timeline-event-time">12 min lalu</span> {{-- Timeline Time --}}
                            </div>
                        </div>
                    </li>
                    {{-- End of looping --}}
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-12 order-1 order-lg-2">
        <div class="card">
            <div class="card-body">
                <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100 mx-1">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="profile-tabs d-flex justify-content-between flex-wrap">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fw-bold active" id="peribadi-tab" data-bs-toggle="tab"
                                        href="#peribadi" aria-controls="peribadi" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Maklumat Peribadi</span>
                                        <i data-feather="rss" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" id="skim-tab" data-bs-toggle="tab" href="#skim"
                                        aria-controls="skim" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Maklumat Skim</span>
                                        <i data-feather="info" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" id="akademik-tab" data-bs-toggle="tab" href="#akademik"
                                        aria-controls="akademik" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Makluamt Akademik</span>
                                        <i data-feather="image" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" id="perkhidmatan-tab" data-bs-toggle="tab" href="#perkhidmatan"
                                        aria-controls="perkhidmatan" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Perkhidmatan Pegawai</span>
                                        <i data-feather="users" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" id="tambahan-tab" data-bs-toggle="tab" href="#tambahan"
                                        aria-controls="tambahan" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Maklumat Tambahan</span>
                                        <i data-feather="users" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" id="tatatertib-tab" data-bs-toggle="tab" href="#tatatertib"
                                        aria-controls="tatatertib" role="tab" aria-selected="true">
                                        <span class="d-none d-md-block">Tatatertib</span>
                                        <i data-feather="users" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="peribadi" role="tabpanel" aria-labelledby="peribadi-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.maklumat_peribadi')
                                </div>
                                <div class="tab-pane fade" id="skim" role="tabpanel" aria-labelledby="skim-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.maklumat_skim')
                                </div>
                                <div class="tab-pane fade" id="akademik" role="tabpanel" aria-labelledby="akademik-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.maklumat_akademik')
                                </div>
                                <div class="tab-pane fade" id="perkhidmatan" role="tabpanel" aria-labelledby="perkhidmatan-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.perkhidmatan')
                                </div>
                                <div class="tab-pane fade" id="tambahan" role="tabpanel" aria-labelledby="tambahan-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.maklumat_tambahan')
                                </div>
                                <div class="tab-pane fade" id="tatatertib" role="tabpanel" aria-labelledby="tatatertib-tab">
                                    <hr>
                                    @include('maklumat_pemohon.pemohon.tatatertib')
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection