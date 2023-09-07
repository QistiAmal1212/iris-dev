@extends('layouts.app')

@section('header')
    Agama
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Agama</a>
    </li>
@endsection

@section('content')
<style>
    #table-religion thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-religion tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-religion {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Agama</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="religionForm()">
            <i class="fa-solid fa-add"></i> Tambah Agama
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-religion">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Agama</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.religionForm')

@endsection

@section('script')
<script>

    var table = $('#table-religion').DataTable({
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

    religionForm = function(id = null){
        var religionFormModal;
        religionFormModal = new bootstrap.Modal(document.getElementById('religionFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#religionForm').attr('action', '{{ route("admin.reference.religion.store") }}');
            $('#religionForm input[name="code"]').val("");
            $('#religionForm input[name="name"]').val("");

            $('#title-role').html('Tambah Agama');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            religionFormModal.show();
        }else{
            url = "{{ route('admin.reference.religion.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    religion_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.religion.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', religion_id);

                    $('#religionForm').attr('action',url2 );
                    $('#religionForm input[name="code"]').val(data.detail.code);
                    $('#religionForm input[name="name"]').val(data.detail.name);

                    $('#religionForm input[name="code"]').prop('readonly', true);

                        $('#religionForm input[name="code"]').css({
                            'background-color': '#f0f0f0',
                            'color': '#666',
                            'border': '1px solid #ccc',
                            'cursor': 'not-allowed'
                        });

                    $('#title-role').html('Kemaskini Agama');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    religionFormModal.show();
                },
            });
        }
    };

</script>
@endsection
