@extends('layouts.app')

@section('header')
    Selenggara Menu
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Selenggara Menu</a>
    </li>
@endsection

@section('content')
<style>
    thead th {
        vertical-align: middle;
        text-align: center;
    }

    tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    table {
        width: 100% !important;
        /* word-wrap: break-word; */
    }
</style>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12" id="menuLevel1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Senarai Menu [Level 1]</h4>
                <button type="button" class="btn btn-primary btn-md float-right" onclick="createMenuForm()">
                    <i class="fa-solid fa-add"></i> Tambah Menu
                </button>
            </div>
            <hr>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered" id="tableLevel1">
                        <thead>
                            <tr>
                                <th width="10%">Turutan</th>
                                <th>Nama Menu</th>
                                <th>Jenis Menu</th>
                                <th>Nama Modul</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="#" class="text-primary">Selenggara Menu</a>
                                </td>
                                <td>Menu</td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="">
                                            <i class="fas fa-pencil text-primary"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-default">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" id="menuLevel2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Senarai Menu [Level 2]</h4>
            </div>
            <hr>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered" id="tableLevel2">
                        <thead>
                            <tr>
                                <th width="10%">Turutan</th>
                                <th>Nama Menu</th>
                                <th>Jenis Menu</th>
                                <th>Nama Modul</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="#" class="text-primary">Pengurusan Data</a>
                                </td>
                                <td>Menu</td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="">
                                            <i class="fas fa-pencil text-primary"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-default">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" id="menuLevel3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Senarai Menu [Level 3]</h4>
            </div>
            <hr>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered" id="tableLevel3">
                        <thead>
                            <tr>
                                <th width="10%">Turutan</th>
                                <th>Nama Menu</th>
                                <th>Jenis Menu</th>
                                <th>Nama Modul</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="#" class="text-primary">Selenggara Menu</a>
                                </td>
                                <td>Menu</td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="">
                                            <i class="fas fa-pencil text-primary"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-default">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
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

@section('script')
<script>
    function showLevel2() {
        var menuLevel2 = document.getElementById("menuLevel2");
        if (menuLevel2.style.display === "none") {
            menuLevel2.style.display = "block";
        } else {
            menuLevel2.style.display = "none";
        }
        }
</script>
@endsection
