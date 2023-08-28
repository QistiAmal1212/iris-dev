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
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    var table = $('#tableLevel1').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 25,
        processing: true,
        serverSide: true, //enable if data is large (more than 50,000)
        ajax: {
            url: "{{ fullUrl().'?level=1' }}",
            cache: false,
        },
        columns: [
            {
                data: "sequence",
                name: "sequence",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
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
                className : "text-center",
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
        language : {
            emptyTable : "Tiada data tersedia",
            info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
            infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
            infoFiltered : "(Ditapis dari _MAX_ entri)",
            search : "Cari:",
            zeroRecords : "Tiada rekod yang ditemui",
            paginate : {
                first : "Pertama",
                last : "Terakhir",
                next : "Seterusnya",
                previous : "Sebelumnya"
            },
            lengthMenu : "Lihat _MENU_ entri",
        }
    });

    var table2 = $('#tableLevel2').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 25,
        processing: true,
        serverSide: true, //enable if data is large (more than 50,000)
        ajax: {
            url: "{{ fullUrl().'?level=2' }}",
            cache: false,
        },
        columns: [
            {
                data: "sequence",
                name: "sequence",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
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
                className : "text-center",
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
        language : {
            emptyTable : "Tiada data tersedia",
            info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
            infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
            infoFiltered : "(Ditapis dari _MAX_ entri)",
            search : "Cari:",
            zeroRecords : "Tiada rekod yang ditemui",
            paginate : {
                first : "Pertama",
                last : "Terakhir",
                next : "Seterusnya",
                previous : "Sebelumnya"
            },
            lengthMenu : "Lihat _MENU_ entri",
        }
    });

    var table3 = $('#tableLevel3').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 25,
        processing: true,
        serverSide: true, //enable if data is large (more than 50,000)
        ajax: {
            url: "{{ fullUrl().'?level=3' }}",
            cache: false,
        },
        columns: [
            {
                data: "sequence",
                name: "sequence",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
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
                className : "text-center",
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
        language : {
            emptyTable : "Tiada data tersedia",
            info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
            infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
            infoFiltered : "(Ditapis dari _MAX_ entri)",
            search : "Cari:",
            zeroRecords : "Tiada rekod yang ditemui",
            paginate : {
                first : "Pertama",
                last : "Terakhir",
                next : "Seterusnya",
                previous : "Sebelumnya"
            },
            lengthMenu : "Lihat _MENU_ entri",
        }
    });

    function createMenuForm() {
        $("#modal-div").load("{{ route('admin.security.menu.create') }}");
    }

    function editMenuForm(id) {
        url = "{{ route('admin.security.menu.edit', ':replaceThis') }}"
        url = url.replace(':replaceThis', id);
        $("#modal-div").load(url);
    }
</script>
@endsection
