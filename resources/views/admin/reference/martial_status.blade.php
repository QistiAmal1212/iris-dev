@extends('layouts.app')

@section('header')
    Taraf Perkahwinan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Taraf Perkahwinan</a>
    </li>
@endsection

@section('content')
<style>
    #table-martial-status thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-martial-status tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-martial-status {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Taraf Perkahwinan</h4>
        <button type="button" class="btn btn-primary btn-md float-right" onclick="maritalStatusForm()">
            <i class="fa-solid fa-add"></i> Tambah Taraf
        </button>
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-martial-status">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Taraf Perkahwinan</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.martialStatusForm')

@endsection

@section('script')
<script>

    var table = $('#table-martial-status').DataTable({
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

    maritalStatusForm = function(id = null){
        var martialStatusFormModal;
        martialStatusFormModal = new bootstrap.Modal(document.getElementById('martialStatusFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#martialStatusForm').attr('action', '{{ route("admin.reference.martial-status.store") }}');
            $('#martialStatusForm input[name="code"]').val("");
            $('#martialStatusForm input[name="name"]').val("");

            $('#title-role').html('Tambah Taraf Perkahwinan');

            martialStatusFormModal.show();
        }else{
            console.log(id);
            url = "{{ route('admin.reference.martial-status.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    martial_status_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.martial-status.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', martial_status_id);

                    $('#martialStatusForm').attr('action',url2 );
                    $('#martialStatusForm input[name="code"]').val(data.detail.code);
                    $('#martialStatusForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Taraf Perkahwinan');

                    martialStatusFormModal.show();
                },
            });
        }
    };

</script>
@endsection
