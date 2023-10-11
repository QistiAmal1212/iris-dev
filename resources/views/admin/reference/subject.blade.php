@extends('layouts.app')

@section('header')
    Matapelajaran
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Matapelajaran</a>
    </li>
@endsection

@section('content')
<style>
    #table-subject thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-subject tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-subject {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

    input[readonly] {
            pointer-events: none;
            /* Disable pointer events */
            background-color: #f0f0f0;
            /* Change background color */
            color: #666;
            /* Change text color */
            border: 1px solid #ccc;
            /* Change border color */
        }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Matapelajaran</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="subjectForm()">
            <i class="fa-solid fa-add"></i> Tambah Matapelajaran
        </button>
        @endif
    </div>
    <hr>
    <div class="card-body">
        <form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="form-label" for="code">Carian Bahagian</label>
                    <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                        <option value="Lihat Semua" selected>Lihat Semua</option>
                        <option value="3">Tingkatan 3 </option>
                        <option value="5">Tingkatan 5 </option>
                        <option value="6">Tingkatan 6 </option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center my-1 ">
                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-subject">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Matapelajaran</th>
                        <th width="10%">Tingkatan</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.subjectForm')

@endsection

@section('script')
<script>

    var table = $('#table-subject').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 25,
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
                className : "text-center",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "code",
                name: "code",
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
                data: "form",
                name: "form",
                className : "text-center",
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

    $('body').on('submit','#form-search',function(e){

        e.preventDefault();

        var form = $("#form-search");

        if(!form.valid()){
            return false;
        }
        var table;

        table = $('#table-subject').DataTable().destroy();

        table = $('#table-subject').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 25,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            deferRender: true,
            ajax: form.attr('action')+"?"+form.serialize(),
            columns: [
                {
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    className : "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "code",
                    name: "code",
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
                    data: "form",
                    name: "form",
                    className : "text-center",
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
        });

    subjectForm = function(id = null){
        var subjectFormModal;
        subjectFormModal = new bootstrap.Modal(document.getElementById('subjectFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#subjectForm').attr('action', '{{ route("admin.reference.subject.store") }}');
            $('#subjectForm input[name="code"]').val("");
            $('#subjectForm input[name="name"]').val("");
            $('#subjectForm input[name="form"]').val("");
            $('#subjectForm input[name="code"]').prop('readonly', false);

            $('#title-role').html('Tambah Matapelajaran');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            subjectFormModal.show();
        }else{
            url = "{{ route('admin.reference.subject.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    subject_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.subject.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', subject_id);

                    $('#subjectForm').attr('action',url2 );
                    $('#subjectForm input[name="code"]').val(data.detail.code);
                    $('#subjectForm input[name="name"]').val(data.detail.name);
                    $('#subjectForm input[name="form"]').val(data.detail.form);

                    $('#subjectForm input[name="code"]').prop('readonly', true);

                    $('#title-role').html('Kemaskini Matapelajaran');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    subjectFormModal.show();
                },
            });
        }
    };

    function toggleActive(subjectId) {
            var url = "{{ route('admin.reference.subject.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', subjectId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + subjectId + '"]');
                        button.classList.toggle('activate');
                        button.classList.toggle('deactivate');

                        // Toggle the icon
                        var icon = button.querySelector('i');
                        if (icon.classList.contains('fa-toggle-on')) {
                            icon.classList.replace('fa-toggle-on', 'fa-toggle-off');
                            icon.classList.replace('text-success', 'text-danger');
                        } else {
                            icon.classList.replace('fa-toggle-off', 'fa-toggle-on');
                            icon.classList.replace('text-danger', 'text-success');
                        }
                    } else {
                        alert('Error toggling active state');
                    }
                },
                error: function(error) {
                    console.error('Error toggling active state:', error);
                }
            });
        }

</script>
@endsection
