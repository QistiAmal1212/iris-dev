@php
$configData = Helper::applClasses();
@endphp

@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">

<style>
    .fill {
        overflow: hidden;
        background-size: cover;
        background-position: center;
        opacity: 0.5;
        background-image: url('{{ asset('images/iris-images/bangunan.jpg') }}');
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <div class="d-none d-lg-flex col-lg-8 align-items-center fill">
        </div>

        <!-- Reset password-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <center>
                    <img class="mb-2" src="{{ asset('images/iris-images/jata_negara.png') }}" style="width: 10vw">
                    <hr>
                    <h2 class="mt-2 card-title fw-bold mb-1"> SISTEM PENGAMBILAN BERSEPADU (IRIS) </h2>

                    <h4 class="card-title fw-bold mb-1">Tukar Kata Laluan Baharu 🔒</h4>
                </center>
                <div class="alert alert-warning mb-2" role="alert">
                    <h6 class="alert-heading">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        Pastikan keperluan ini dipenuhi:
                    </h6>
                    <div class="alert-body fw-normal"> Minimum panjang kata laluan adalah 12 huruf, kombinasi antara huruf besar dan kecil, karakter & nombor.</div>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="reset-password-new">Kata Laluan Baharu</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="reset-password-new" type="password" name="password" placeholder="············" aria-describedby="reset-password-new" autofocus="" tabindex="1" required />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="reset-password-confirm">Sahkan Kata Laluan Baharu</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="reset-password-confirm" type="password" name="password_confirmation" placeholder="············" aria-describedby="reset-password-confirm" tabindex="2" required />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    @if($errors->any())
                    {!! implode('', $errors->all('
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="alert-body">
                            :message
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ')) !!}
                    @endif
                    <button class="btn btn-primary w-100" tabindex="3">Tukar Kata Laluan</button>
                </form>
                <div class="divider my-2">
                    <div class="divider-text">atau</div>
                </div>

                <p class="text-center mt-2">
                    <a href="{{ route('login') }}">
                        <span>Log Masuk ke Sistem</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Reset password-->
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/pages/auth-reset-password.js')) }}"></script>
@endsection
