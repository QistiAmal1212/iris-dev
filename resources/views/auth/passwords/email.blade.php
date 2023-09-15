@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Lupa Kata Laluan')

@section('page-style')
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

        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <center>
                    <img class="mb-2" src="{{ asset('images/iris-images/jata_negara.png') }}" style="width: 10vw">
                    <hr>
                    <h2 class="mt-2 card-title fw-bold mb-1"> SISTEM PENGAMBILAN BERSEPADU (IRIS) </h2>

                    <h4 class="card-title fw-bold mb-1">Lupa Kata Laluan 🔒</h4>
                    <p class="card-text mb-2">Masukkan emel yang telah didaftarkan</p>

                </center>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-1">
                        <label class="form-label" for="forgot-password-email">Emel</label>
                        <input class="form-control" id="forgot-password-email" type="email" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" autofocus="" tabindex="1" required />
                    </div>
                    @if($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="alert-body">
                                Tiada rekod pengguna dengan alamat e-mel itu.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(Session::has('status'))
                        <div class="alert alert-success">
                            <ul>
                                <li>E-mel pautan tetapan semula kata laluan telah dihantar</li>
                            </ul>
                        </div>
                    @endif
                    <button class="btn btn-primary w-100" tabindex="2">Hantar Pautan Set Semula</button>

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
    </div>
</div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/pages/auth-forgot-password.js')) }}"></script>
@endsection
