@extends('layouts.app')

@section('header')
LOG
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.log')}}">Log</a></li>
@endsection

@section('content')

<!-- custom search filter -->
<form method="GET">
    <div class="card collapsed-card">
        <div class="card-header border-0">
            <span class="card-title searchTitle m-0"> <i class="fas fa-search mr-1"></i> {{__('msg.advanced_search')}} </span>
            <div class="card-tools">
                <button type="button" class="btn btn-sm" data-card-widget="collapse"> <i class="fas fa-plus"></i> </button>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="row">

                <div class="form-group col-md-4">
                    <label><strong> Date Start </strong></label>
                    {{-- <input type="date" name="date_start" value="{{ $request->date_start }}" class="form-control" /> --}}
                    <input type="date" name="date_start" value="" class="form-control" />
                </div>

                <div class="form-group col-md-4">
                    <label><strong> Date End </strong></label>
                    {{-- <input type="date" name="date_end" value="{{ $request->date_end }}" class="form-control" /> --}}
                    <input type="date" name="date_end" value="" class="form-control" />
                </div>

            </div>
        </div>
    </div>
</form>
<!-- /.custom search filter -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-condensed table-hover" id="table">
                <thead>
                    <tr>
                        <th bgcolor="#f0f0f0" class="fit align-top text-left" style="color:#000">No.</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Activity</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Module</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Details</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">User</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">IP Address</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Date & Time</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">

var table = $('#table');

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
        {
            text: '<i class="fa fa-print m-r-5"></i> Print',
            extend: 'print',
            className: 'btn btn-default btn-sm',
            exportOptions: {
                columns: ':visible:not(.nowrap)'
            }
        },
        {
            text: '<i class="fa fa-download m-r-5"></i> Excel',
            extend: 'excelHtml5',
            className: 'btn btn-default btn-sm',
            exportOptions: {
                columns: ':visible:not(.nowrap)'
            }
        },
        {
            text: '<i class="fa fa-download m-r-5"></i> PDF',
            extend: 'pdfHtml5',
            className: 'btn btn-default btn-sm',
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
