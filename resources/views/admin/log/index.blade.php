@extends('layouts.app')

@section('header')
    Jejak Audit
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.log')}}">Jejak Audit</a></li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bolder">
            Senarai Jejak Audit
        </h4>
    </div>

    <hr>

    <div class="card-body">
        <form action="GET">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="fw-bolder"> Aktiviti </label>
                    <input type="text" name="" id="" class="form-control" />
                </div>

                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="fw-bolder"> Modul </label>
                    <input type="text" name="" id="" class="form-control" />
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label class="fw-bolder"> Tarikh Mula </label>
                    <input type="date" name="date_start" id="" class="form-control" />
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label class="fw-bolder"> Tarikh Akhir</label>
                    <input type="date" name="date_end" id="" class="form-control" />
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center my-1 ">
                <a class="me-3" type="button" id="reset" href="#">
                    <span class="text-danger"> Set Semula </span>
                </a>
                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>

    <div class="card-footer">
        <div class="table-responsive">
            <table class="table table-condensed table-hover" id="activityLog">
                <thead>
                    <tr>
                        <th class="text-uppercase fw-bolder">No.</th>
                        <th class="text-uppercase fw-bolder">Aktiviti</th>
                        <th class="text-uppercase fw-bolder">Modul</th>
                        <th class="text-uppercase fw-bolder">Perincian</th>
                        <th class="text-uppercase fw-bolder">Pengguna</th>
                        <th class="text-uppercase fw-bolder">Alamat IP</th>
                        <th class="text-uppercase fw-bolder">Tarikh & Masa</th>
                        <th class="text-uppercase fw-bolder">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">

var table = $('#activityLog');

var settings = {
    "processing": true,
    "serverSide": true,
    "deferRender": true,
    "ajax": "{{ fullUrl() }}",
    "columns": [
        { data: 'index', defaultContent: '', orderable: false, searchable: false, render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }},        
        { data: "activity_type.name", name: "activity_type.name", render: function(data, type, row){
            return $("<div/>").html(data).text();
        }},
        { data: "module.name", name: "module.name"}, 
        { data: "description", name: "description"},     
        { data: "created_by_user_id", name: "created_by_user_id", render: function(data, type, row){
            return $("<div/>").html(data).text();
        }},   
        { data: "ip_address", name: "ip_address"},        
        { data: "created_at", name: "created_at"},
        { data: "action", name: "action", orderable: false, searchable: false},
    ],
    "columnDefs": [
        { className: "nowrap", "targets": [ 7 ] }
    ],
    "bSortable": false,
    // "sDom": "B<t><'row'<p i>>",
    "sDom": "Blfrtip",
    "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
    "buttons": [
        // {
        //     text: '<i class="fa fa-print m-r-5"></i> Print',
        //     extend: 'print',
        //     className: 'btn btn-default btn-sm',
        //     exportOptions: {
        //         columns: ':visible:not(.nowrap)'
        //     }
        // },
        {
            text: '<div class="btn-group" role="group" aria-label="Role Action"> <i class="fa fa-file-excel text-success"></i> Excel ',
            extend: 'excelHtml5',
            className: 'btn btn-outline-success waves-effect mb-2',
            exportOptions: {
                columns: ':visible:not(.nowrap)'
            }
        },
        {
            text: '<i class="fa fa-file-pdf text-danger"></i> PDF </div>',
            extend: 'pdfHtml5',
            className: 'btn btn-outline-danger waves-effect mb-2',
            exportOptions: {
                columns: ':visible:not(.nowrap)'
            }
        },
    ],
    "destroy": true,
    "scrollCollapse": true,
    "pagingType": "full_numbers",
    "oLanguage": {
        "sEmptyTable":      "No result",
        "sInfo":            "Showing _START_ to _END_ from _TOTAL_ record",
        "sInfoEmpty":       "Showing 0 record",
        "sInfoFiltered":    "(Filtered from total _MAX_ record)",
        "sInfoPostFix":     "",
        "sInfoThousands":   ",",
        "sLengthMenu":      "Show _MENU_ record",
        "sLoadingRecords":  "Processed...",
        "sProcessing":      "Processing...",
        "sSearch":          "Searching:",
       "sZeroRecords":      "No record matches found.",
       "oPaginate": {
           "sFirst":        "First",
           "sPrevious":     "Previous",
           "sNext":         "Next",
           "sLast":         "Last"
       },
       "oAria": {
           "sSortAscending":  ": diaktifkan kepada susunan lajur menaik",
           "sSortDescending": ": diaktifkan kepada susunan lajur menurun"
       }
    },
    "iDisplayLength": 25
};

table.dataTable(settings);

function view(id) {
    $("#modal-div").load("{{ route('admin.log') }}/"+id);
}

</script>
@endpush

@section('script')
<script>
    $(".btnViewLog").on('click', function(){

        $("#description").val('');
        $("#subject_type").val('');
        $("#event").val('');
        $("#created_at").val('');

        var activity_json = $(this).attr('data-activity');

        try {
            var activity_obj = JSON.parse(activity_json);
            console.log(activity_obj);

            $("#description").val(activity_obj.description);
            $("#subject_type").val(activity_obj.subject_type);
            $("#event").val(activity_obj.event);
            $("#created_at").val(activity_obj.created_at);

        } catch (error) {

        }

        $("#logDetail").html('');
        var data_raw = $(this).attr('data-properties');
        if (isJson(data_raw)) {
            data_raw = JSON.stringify(JSON.parse(data_raw), null, 3);
        }

        $("#logDetail").html(data_raw);
        $("#viewLogModal").modal('show');
    });

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
</script>
@endsection
