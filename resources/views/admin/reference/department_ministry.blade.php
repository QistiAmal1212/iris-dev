@extends('layouts.app')

@section('header')
    Kementerian
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Kementerian</a>
    </li>
@endsection

@section('content')
<style>
    #table-department-ministry thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-department-ministry tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-department-ministry {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Kementerian</h4>
        <button type="button" class="btn btn-primary btn-md float-right" onclick="departmentMinistryForm()">
            <i class="fa-solid fa-add"></i> Tambah Kementerian
        </button>
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-department-ministry">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Nama Kementerian</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.departmentMinistryForm')

@endsection

@section('script')
<script>

    var table = $('#table-department-ministry').DataTable({
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

    departmentMinistryForm = function(id = null){
        var departmentMinistryFormModal;
        departmentMinistryFormModal = new bootstrap.Modal(document.getElementById('departmentMinistryFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#departmentMinistryForm').attr('action', '{{ route("admin.reference.department-ministry.store") }}');
            $('#departmentMinistryForm input[name="code"]').val("");
            $('#departmentMinistryForm input[name="name"]').val("");

            $('#title-role').html('Tambah Kementerian');

            departmentMinistryFormModal.show();
        }else{
            console.log(id);
            url = "{{ route('admin.reference.department-ministry.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    department_ministry_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.department-ministry.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', department_ministry_id);

                    $('#departmentMinistryForm').attr('action',url2 );
                    $('#departmentMinistryForm input[name="code"]').val(data.detail.code);
                    $('#departmentMinistryForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Kementerian');

                    departmentMinistryFormModal.show();
                },
            });
        }
    };

</script>
@endsection
