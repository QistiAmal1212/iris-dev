@extends('layouts.app')

@section('header')
Management Flow
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="id_name">Flow management</h3>
                </div>
                <div class="card-body">

                    <div class="card">
                        <div class="card-header">

                            <form method="POST" action="{{ route('flow.indera_UI_index') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="role_id"> Choose role</label>
                                            <div class="input-group">
                                                <select class="form-select" id="role_id" name="role_id">
                                                    <option value="" hidden>Please Choose</option>
                                                    @foreach ( $allRole as $role)
                                                    <option value="{{ $role->id }}">{{ strtoupper($role->name) }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="status_id"> Choose Status</label>
                                            <div class="input-group">
                                                <select class="form-select" id="status_id" name="status_id">
                                                    <option value="" hidden>Please Choose </option>
                                                    @foreach ( $flowHasModule->flowStatuses()->get() as $status)
                                                        <option value="{{ $status->id }}">{{ $status->status_index }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-outline-secondary" type="submit">Submit</button>
                            </form>

                        </div>
                        <div class="card-body">
                            @php
                                $status_ro_section_a = [18,21];
                                $status_ro_section_b = [18,19,21];
                                $status_ro_section_c = [18,19,21];
                            @endphp
                            <div class="alert alert-primary" role="alert" hidden="hidden" id="alertStatus">
                                <h4 class="alert-heading">Next Status</h4>
                                <div class="alert-body">
                                <span>Next Status is </span><span id="statusText"></span><span id="statusDescText"></span>
                                </div>
                            </div>
                            @if (in_array($user_status,$status_ro_section_a))
                                @include('flow_management.components.section_a')
                            @endif

                            @if (in_array($user_status,$status_ro_section_b))
                                @include('flow_management.components.section_b')
                            @endif

                            @if (in_array($user_status,$status_ro_section_c))
                                @include('flow_management.components.section_c')
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>

retrieveNextValue = function(role,action,status){

    var data = new FormData();
    data.append('role',role);
    data.append('action',action);
    data.append('status',status);

    $.ajax({
        url: '{{route("flow.next")}}',
        method: "POST",
        data: data,
        async: true,
        contentType: false,
        processData: false,
        success: function(data) {
            toastr.success(data.title ?? "Saved");
            event.preventDefault();

            $('#alertStatus').removeAttr('hidden');
            $('#statusText').html(data.statusText);
            $('#statusDescText').html(data.statusDescText);
        },
    });
};
</script>
@endsection

@section('developer-script')
<script>
$(function(){

    $('.flatpickr').flatpickr({
        dateFormat: 'd/m/Y',
        allowInput: true
    });



});
</script>
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
