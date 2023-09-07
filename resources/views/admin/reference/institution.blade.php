@extends('layouts.app')

@section('header')
    Institusi
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Institusi</a>
    </li>
@endsection

@section('content')
<style>
    #table-institution thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-institution tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-institution {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Institusi</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="institutionForm()">
            <i class="fa-solid fa-add"></i> Tambah Institusi
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-institution">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Nama Institusi</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.institutionForm')

@endsection

@section('script')
<script>

    var table = $('#table-institution').DataTable({
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

    institutionForm = function(id = null){
        var institutionFormModal;
        institutionFormModal = new bootstrap.Modal(document.getElementById('institutionFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#institutionForm').attr('action', '{{ route("admin.reference.institution.store") }}');
            $('#institutionForm input[name="code"]').val("");
            $('#institutionForm input[name="name"]').val("");

            $('#title-role').html('Tambah Institusi');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            institutionFormModal.show();
        }else{
            url = "{{ route('admin.reference.institution.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    institution_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.institution.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', institution_id);

                    $('#institutionForm').attr('action',url2 );
                    $('#institutionForm input[name="code"]').val(data.detail.code);
                    $('#institutionForm input[name="name"]').val(data.detail.name);

                    $('#institutionForm input[name="code"]').prop('readonly', true);

                        $('#institutionForm input[name="code"]').css({
                            'background-color': '#f0f0f0',
                            'color': '#666',
                            'border': '1px solid #ccc',
                            'cursor': 'not-allowed'
                        });

                    $('#title-role').html('Kemaskini Institusi');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    institutionFormModal.show();
                },
            });
        }
    };

</script>
@endsection
