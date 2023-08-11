@extends('layouts.app')

@section('header')
Maklumat Pemohon
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="#"> Maklumat Pemohon </a></li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bolder">Carian Maklumat Pemohon</h4>
    </div>

    <hr>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <label class="fw-bolder mb-1">No. Kad Pengenalan Calon:</label>
                <div class="input-group">
                    <input type="text" class="form-control"
                        placeholder="Isikan no. kad pengenalan calon dan tekan butang Cari">
                    <button class="btn btn-primary waves-effect" type="button">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection