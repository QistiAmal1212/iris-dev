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
        <form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="fw-bolder"> Aktiviti </label>
                    <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                        <option value="Lihat Semua" selected>Lihat Semua</option>
                        @foreach($activityType as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="fw-bolder"> Modul </label>
                    <select name="module_id" id="module_id" class="select2 form-control">
                        <option value="Lihat Semua" selected>Lihat Semua</option>
                        @foreach($module as $modul)
                        <option value="{{ $modul->id }}">{{ $modul->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label class="fw-bolder"> Tarikh Mula </label>
                    <input type="date" name="date_start" id="date_start" class="form-control" />
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label class="fw-bolder"> Tarikh Akhir</label>
                    <input type="date" name="date_end" id="date_end" class="form-control" />
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center my-1 ">
                <a class="me-3" type="button" id="reset" onclick="resetFilterForm()">
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
    };

    table.dataTable(settings);

    $('body').on('submit','#form-search',function(e){

        e.preventDefault();

        var form = $("#form-search");

        if(!form.valid()){
            return false;
        }
        var table;

        table = $('#activityLog').DataTable().destroy();

        table = $('#activityLog').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 10,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            deferRender: true,
            ajax: form.attr('action')+"?"+form.serialize(),
            columns: [
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
    });

    function resetFilterForm() {
        $('#form-search')[0].reset();
        $("#form-search").trigger("reset");
        $('#form-search select').val("").trigger("change");
    }

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
