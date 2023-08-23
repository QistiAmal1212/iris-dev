@extends('layouts.app')

@section('header')
Pengurusan Integrasi
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
<li class="breadcrumb-item"><a>Pengurusan Integrasi</a></li>
@endsection

@section('content')
<style>
    #integrationList thead th {
        vertical-align: middle;
        text-align: center;
    }

    #integrationList tbody {
        vertical-align: middle;
        text-align: center;
    }

    #integrationList {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="row match-height">
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Jumlah Peranan [Dalaman}</span>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="{{asset('images/avatars/2.png')}}" alt="Avatar" />
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                    <div class="role-heading">
                        {{-- <h4 class="fw-bolder">{{ $countInternalRoles }}</h4> --}}
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#internal_list" aria-controls="internal_list" title="">
                            <i class="fa-solid fa-chevron-down"></i>
                            Lihat Senarai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Jumlah Peranan [Luaran}</span>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="{{asset('images/avatars/4.png')}}" alt="Avatar" />
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                    <div class="role-heading">
                        {{-- <h4 class="fw-bolder">{{ $countExternalRoles }}</h4> --}}
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#external_list" aria-controls="external_list" title="">
                            <i class="fa-solid fa-chevron-down"></i>
                            Lihat Senarai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="row">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end justify-content-center h-100">
                        <img src="{{asset('images/illustration/faq-illustrations.svg')}}" class="img-fluid mt-2" alt="Image" width="85" />
                    </div>
                </div>
                <div class="col-sm-7">
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Senarai API Integrasi</h4>
                <div class="d-flex justify-content-end align-items-center">
                    <a data-bs-toggle="modal" data-bs-target="#new_integration" aria-controls="new_integration" class="btn btn-primary float-right" title="">
                        <i class="fa-solid fa-add"></i>
                        Tambah API
                    </a>

                    @include('admin.integrasi.integration_form')
                </div>
            </div>

            <hr>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered table-responsive" id="integrationList">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>ID API</th>
                                <th>URL API</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>API001</td>
                                <td>https://api.example.com:8443/v1/reports</td>
                                <td>
                                    <span class="badge badge-rounded badge-light-primary fw-bolder">Aktif</span>
                                </td>
                                <td>
                                    <div class="demo-inline-spacing justify-content-center align-content-center">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="customSwitch3" value="1" name="status" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

