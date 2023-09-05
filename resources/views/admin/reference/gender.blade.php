@extends('layouts.app')

@section('header')
    Jantina
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Jantina</a>
    </li>
@endsection

@section('content')
<style>
    #table-gender thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-gender tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-gender {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Jantina</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="genderForm()">
            <i class="fa-solid fa-add"></i> Tambah Jantina
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-gender">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Jantina</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.genderForm')

@endsection

@section('script')
<script>

    var table = $('#table-gender').DataTable({
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

    genderForm = function(id = null){
        var genderFormModal;
        genderFormModal = new bootstrap.Modal(document.getElementById('genderFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#genderForm').attr('action', '{{ route("admin.reference.gender.store") }}');
            $('#genderForm input[name="code"]').val("");
            $('#genderForm input[name="name"]').val("");

            $('#title-role').html('Tambah Jantina');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            genderFormModal.show();
        }else{
            url = "{{ route('admin.reference.gender.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    gender_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.gender.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', gender_id);

                    $('#genderForm').attr('action',url2 );
                    $('#genderForm input[name="code"]').val(data.detail.code);
                    $('#genderForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Jantina');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    genderFormModal.show();
                },
            });
        }
    };

</script>
@endsection