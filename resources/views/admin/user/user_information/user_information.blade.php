@extends('layouts.app')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('header')
Maklumat Profil
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
<li class="breadcrumb-item"><a>Maklumat Profil</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
        <div class="card">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <span class="avatar bg-light-secondary p-50">
                            @php
                            $exp_username = explode(' ', Auth::user()->name);
                            $short_name = substr($exp_username[array_key_first($exp_username)], 0, 1);
                                if (count($exp_username) > 1) {
                                    $short_name = $short_name . '' . substr($exp_username[array_key_last($exp_username)], 0, 1);
                                }
                            @endphp
                                <span class="avatar-content">{{ $short_name }}</span>
                                <span class="avatar-status-online"></span>
                        </span>
                        <br>
                        <div class="user-info text-center">
                            <h3 class="fw-bolder mb-1">{{ $user->name }}</h3>
                            @foreach ($user->getRoleNames() as $role)
                                @if ($role == 'admin')
                                    <span class="badge bg-light-primary">{{ Str::ucfirst($role) }}</span>
                                @elseif ($role == 'superadmin')
                                    <span class="badge bg-light-success">{{ Str::ucfirst($role) }}</span>
                                @elseif ($role == 'pengguna_luar')
                                    <span class="badge bg-light-warning">{{ Str::ucfirst($role) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>

                <form method="POST" action="#" refreshFunctionDivId="divUpdateUser" data-swal="Akaun berjaya dikemaskini.">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Nombor Kad Pengenalan:</label>
                            <input type="text" class="form-control" value="{{ $user->no_ic }}" id="no_ic" name="no_ic" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Nama Pengguna:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Emel:</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Nombor Telefon:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Kementerian:</label>
                            <select name="department" id="department" class="form-select select2">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }} {{ $user->department_ministry->name ? 'selected' : '' }}">
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label fw-bolder">Jawatan:</label>
                            <select name="skim" id="skim" class="form-select select2">
                                @foreach ($skims as $skim)
                                    <option value="{{ $skim->id }} {{ $user->skim->name ? 'selected' : '' }}">
                                        {{ $skim->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1" hidden>
                            <label class="form-label fw-bolder">Peranan:</label>
                            <select class="select2 form-select" id="select2-multiple" name="roles[]" id="roles" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1" hidden>
                            <label class="form-label fw-bolder">Status :</label>
                            <input type="text" class="form-control" id="is_active" name="is_active" value="{{ $user->is_active }}">
                        </div>

                    </div>

                    <button type="button" class="btn btn-success" onclick="generalFormSubmit(this);" id="update_account_button" hidden></button>
                </form>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="$('#update_account_button').trigger('click');">
                        <span class="align-middle d-sm-inline-block d-none">
                            Kemaskini Maklumat
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 col-xl-8 col-12">
        @include('admin.user.user_information.nav_user_information')
    </div>
</div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
