@extends('layouts.app')

@section('header')
    Selenggra Menu
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Selenggara Menu</a>
    </li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Menu</h4>
        <button type="button" class="btn btn-success btn-sm float-right" onclick="createMenuForm()">
            <i class="fa-solid fa-add"></i> Tambah Menu
        </button>
    </div>
    <hr>
    <div class="card-body">
        <form id="form-search" method="GET" action="" novalidate>
        <div class="row">
            <div class="col-sm-4 col-12 mb-1">
                <label class="fw-bolder">Level</label>
                <select class="form-control" name="level" id="level">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="d-flex justify-content-end align-items-center my-1 ">
                <a class="me-3" type="button" id="reset" href="#">
                    <span class="text-danger"> Set Semula </span>
                </a>
                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="table-responsive">
            <table class="table table-condensed table-hover" id="table-menu">
                <thead>
                    <tr>
                        <th bgcolor="#f0f0f0" class="fit align-top text-left" style="color:#000">Bil</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Nama</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Jenis</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Modul</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Level</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Turutan</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Pautan Menu</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $(function() {
        var table = $('#table-menu').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 10,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            ajax: {
                url: "{{ fullUrl() }}",
                cache: false,
            },
            columns: [
                {
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "name",
                    name: "name",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "type",
                    name: "type",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "module_id",
                    name: "module_id",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "level",
                    name: "level",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "sequence",
                    name: "sequence",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "menu_link",
                    name: "menu_link",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
        });

    });

    function createMenuForm() {
        $("#modal-div").load("{{ route('admin.security.menu.create') }}");
    }
</script>
@endsection