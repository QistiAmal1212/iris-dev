@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="#">
                {{-- <img class="" src="{{ asset('images/logo/logo-icon.png') }}" alt="Login V2" width="25" /> --}}
                <h2 class="brand-text text-primary ms-1">{{$system_name}}</h2>
            </a>
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if ($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{ asset('images/pages/login-v2-dark.svg') }}" alt="Login V2" />
                    @else
                        <img class="img-fluid" src="{{ asset('images/pages/login-v2.svg') }}" alt="Login V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Welcome to {{$system_name}}</h2>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

                    @if (env('APP_ENV') != 'production')
                        <p class="login-box-msg">
                            {{__('msg.loginInstruction')}}
                            <br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginDemo">
                                <small class="colorTitle"><u> {{__('msg.loginInstruction2')}}</u></small>
                            </a>
                        </p>
                    @endif

                    <form id="loginForm" class="auth-login-form mt-2" method="post" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="login-email">Email</label>
                            <input class="form-control" id="login-email" type="text" name="email"
                                placeholder="john@example.com" aria-describedby="login-email" autofocus=""
                                tabindex="1" />
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                                <a href="{{ route('password.request') }}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="login-password" type="password"
                                    name="password" placeholder="············" aria-describedby="login-password"
                                    tabindex="2" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                <label class="form-check-label" for="remember-me"> Remember Me</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                    </form>
                    @if (in_array(env('APP_ENV'),['production','staging']))
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('google.redirect') }}">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                        </a>
                    </div>
                    @endif
                    {{-- <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{ url('auth/register-cover') }}"><span>&nbsp;Create an account</span></a>
                    </p>
                    <div class="divider my-2">
                        <div class="divider-text">or</div>
                    </div>
                    <div class="auth-footer-btn d-flex justify-content-center">
                        <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
                        <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>
                        <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
                        <a class="btn btn-github" href="#"><i data-feather="github"></i></a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>

@if (!in_array(env('APP_ENV'),['production']))
    <div class="modal login fade right" id="loginDemo" tabindex="-1" aria-labelledby="loginDemo" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pengguna Demo untuk {{$system_name}}® : <b>{{ucwords(env('APP_ENV','local'))}}</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <div class="modal-body height-40">
                    <div class="list-group">
                        <a href="javascript:demoLogin(0)" class="list-group-item list-group-item-action">Superadmin </a>
                        <a href="javascript:demoLogin(1)" class="list-group-item list-group-item-action">Admin</a>
                        <a href="javascript:demoLogin(2)" class="list-group-item list-group-item-action">[ Test Module ] Pengguna Luar 1</a>
                        <a href="javascript:demoLogin(3)" class="list-group-item list-group-item-action">[ Test Module ] Pengguna Luar 2</a>
                        <a href="javascript:demoLogin(4)" class="list-group-item list-group-item-action">[ Test Module ] Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/pages/auth-login.js')) }}"></script>
@endsection

@section('script')
<script>
@if (env('APP_ENV') != 'production')
    function demoLogin(index) {
        var credential = [{
                email: 'superadmin@yopmail.com',
                password: 'password',
            },
            {
                email: 'admin@yopmail.com',
                password: 'password',
            },
            {
                email: 'pl1@gmail.com',
                password: 'password',
            },
            {
                email: 'pl2@gmail.com',
                password: 'password',
            },
            {
                email: 'admintest@gmail.com',
                password: 'password',
            }
        ];

        $('[name="email"]').val(credential[index].email);
        $('[name="password"]').val(credential[index].password);
        $('#loginDemo').modal('hide');
        $('#loginForm')[0].submit();
    }
@endif
</script>

@endsection
