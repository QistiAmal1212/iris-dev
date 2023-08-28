@extends('layouts.app')

@section('header')
    Keturunan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Keturunan</a>
    </li>
@endsection

@section('content')
<style>
    #table-race thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-race tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-race {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Keturunan</h4>
        <button type="button" class="btn btn-primary btn-md float-right" onclick="raceForm()">
            <i class="fa-solid fa-add"></i> Tambah Keturunan
        </button>
    </div>
    <hr>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-race">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Keturunan</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.raceForm')

@endsection

@section('script')
<script>

    var table = $('#table-race').DataTable({
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

    raceForm = function(id = null){
        var raceFormModal;
        raceFormModal = new bootstrap.Modal(document.getElementById('raceFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#raceForm').attr('action', '{{ route("admin.reference.race.store") }}');
            $('#raceForm input[name="code"]').val("");
            $('#raceForm input[name="name"]').val("");

            $('#title-role').html('Tambah Keturunan');

            raceFormModal.show();
        }else{
            url = "{{ route('admin.reference.race.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    race_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.race.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', race_id);

                    $('#raceForm').attr('action',url2 );
                    $('#raceForm input[name="code"]').val(data.detail.code);
                    $('#raceForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Keturunan');

                    raceFormModal.show();
                },
            });
        }
    };

</script>
@endsection
