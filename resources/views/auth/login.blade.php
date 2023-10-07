@php
    $configData = Helper::applClasses();
@endphp

@extends('layouts/fullLayoutMaster')

@section('title', 'Log Masuk')

@section('vendor-style')
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

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

                        <p class="card-text mb-2">Log masuk untuk mengakses sistem.</p>

                        @if (env('APP_URL') != 'production')
                            <p class="login-box-msg">
                                Sila log masuk menggunakan akaun berdaftar
                                <br>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginDemo">
                                    <small class="colorTitle"><u> Pengguna Demo </u></small>
                                </a>
                            </p>
                        @endif
                    </center>

                    <form id="loginForm" class="auth-login-form mt-2" method="post" action="{{ url('/login') }}">
                        @csrf
                        {{-- <div class="mb-1">
                            <label class="form-label" for="login-email">Emel</label>
                            <input class="form-control" id="login-email" type="text" name="email"
                                placeholder="john@example.com" aria-describedby="login-email" autofocus=""
                                tabindex="1" required/>
                        </div> --}}

                        @error('active')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div class="alert-body">
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        @error('no_ic')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div class="alert-body">
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <div class="mb-1">
                            <label class="form-label fw-bolder" for="login-ic">No Kad Pengenalan</label>
                            <input class="form-control" id="login-ic" type="text" name="no_ic"
                                placeholder="No Kad Pengenalan Tanpa '-'" aria-describedby="login-ic" autofocus=""
                                tabindex="1" minlentgh=12 maxlength=12 required value="{{ $cookieName }}" />
                        </div>

                        <div class="mb-1">

                            <div class="d-flex justify-content-between">
                                <label class="form-label fw-bolder" for="login-password">Kata Laluan</label>
                                <a href="{{ route('password.request') }}">
                                    <small>Lupa Kata Laluan?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="login-password" type="password"
                                    name="password" placeholder="············" aria-describedby="login-password"
                                    tabindex="2" required value="{{ $cookiePassword }}"/>
                                <span class="input-group-text cursor-pointer">
                                    <i data-feather="eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-1">
                            @error('captcha')
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div class="alert-body">
                                        Pengesahan CAPTCHA gagal. Sila cuba semula.
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <a type="button" data-toggle="tooltip" title="Set Semula Captcha" id="reload"><i class="fas fa-undo text-secondary"></i></a>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="captcha"
                                placeholder="Masukkan Captcha" aria-describedby="captcha" autofocus=""
                                tabindex="1" required/>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" id="remember-me" name="remember_login" type="checkbox" tabindex="3" value="1" @if($cookieName != null || $cookiePassword != null) checked @endif/>
                                <label class="form-check-label" for="remember-me"> Ingat Maklumat Log Masuk </label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 login-tour" tabindex="4">Daftar Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!in_array(env('APP_ENV'), ['production']))
        <div class="modal login fade right" id="loginDemo" tabindex="-1" aria-labelledby="loginDemo"
            data-bs-backdrop="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top: 65%">
                    <div class="modal-header">
                        <h4 class="modal-title">Pengguna Demo untuk [IRIS]®</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body login" style="height:10%; ">
                        <div class="list-group">
                            <a href="javascript:demoLogin(0)" class="list-group-item list-group-item-action">
                                Superadmin
                            </a>
                            <a href="javascript:demoLogin(1)" class="list-group-item list-group-item-action">
                                Pengguna Dalaman
                            </a>
                            <a href="javascript:demoLogin(2)" class="list-group-item list-group-item-action">
                                Pengguna Luar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/pages/auth-login.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection

@section('script')
    <script>

        $('#reload').click(function() {
            $.ajax({
                method : "GET",
                url : "{{ route('reload.captcha') }}",
                success:function(data){
                    $(".captcha span").html(data.captcha)
                }
            });
        });

        @if (env('APP_URL') != 'production')
            function demoLogin(index) {
                var credential = [{
                        email: 'superadmin@yopmail.com',
                        no_ic: '990101010101',
                        password: 'password',
                    },
                    {
                        email: 'admin@yopmail.com',
                        no_ic: '990101010102',
                        password: 'password',
                    },
                    {
                        email: 'pengguna_luar@yopmail.com',
                        password: 'password',
                    }
                ];

                //$('[name="email"]').val(credential[index].email);
                $('[name="no_ic"]').val(credential[index].no_ic);
                $('[name="password"]').val(credential[index].password);
                $('#loginDemo').modal('hide');
                //$('#loginForm')[0].submit();
            }
        @endif
    </script>
@endsection
