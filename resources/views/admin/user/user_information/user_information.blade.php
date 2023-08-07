@extends('layouts.app')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('header')
Profile Information
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
<li class="breadcrumb-item"><a>Profile Information</a></li>
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

                <table class="table" width="100%">
                    <tr>
                        <td class="fw-bolder">Username: </td>
                        <td>
                            <input type="text" class="form-control" value="{{ $user->name }}">
                        </td>
                    </tr>

                    <tr>
                        <td class="fw-bolder">Email: </td>
                        <td>
                            <input type="text" class="form-control" value="{{ $user->email }}">
                        </td>
                    </tr>

                    <tr>
                        <td class="fw-bolder">Status</td>
                        <td>
                            @if($user->is_active == '1')
                                <span class="badge bg-light-primary">Active</span>
                            @else
                                <span class="badge bg-light-danger">Suspended</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="fw-bolder">Role</td>
                        <td>
                            <select class="select2 form-select" id="select2-multiple" name="roles[]" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <a href="javascript();" class="btn btn-primary me-1">
                        Update
                    </a>
                    <a href="javascript();" class="btn btn-outline-danger suspend-user">Suspend Account</a>
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
