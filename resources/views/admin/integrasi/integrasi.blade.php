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
    {{-- <div class="col-xl-4 col-lg-6 col-md-6">
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
    </div> --}}


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
                                <th>Nama API</th>
                                <th>URL API</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($senaraiApi as $api)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a class="btn text-primary float-right" href="{{ route('integration_information', $api->id) }}">
                                        {{ "API".substr(str_repeat(0, 3).$api->id, - 3); }}
                                    </a>
                                </td>
                                <td>{{ $api->nama }}</td>
                                <td>{{ url('/').'/'.$api->url }}</td>
                                <td>
                                    @if($api->status)
                                    <span class="badge badge-rounded badge-light-primary fw-bolder">Aktif</span>
                                    @else
                                    <span class="badge badge-rounded badge-light-danger fw-bolder">Tidak Aktif</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <div class="justify-content-center align-content-center">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="customSwitch3" value="1" name="status" {{ ($api->status) ? "checked" : "" }}/>
                                        </div>
                                    </div>
                                </td> --}}
                                <td>
                                    @if($api->url != 'api/pemohon/store')
                                    <a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="editApi('{{ $api->id }}')"> <i class="fas fa-pencil text-primary"></i> 
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function editApi(id) {
        url = "{{route('edit.api',':replaceThis')}}"
        url = url.replace(':replaceThis',id);
        $("#modal-div").load(url);
    }
</script>
@endsection

