@extends('layouts.app')

@section('header')
    Pangkat
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Pangkat</a>
    </li>
@endsection

@section('content')
<style>
    #table-rank thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-rank tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-rank {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Pangkat</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="rankForm()">
            <i class="fa-solid fa-add"></i> Tambah Pangkat
        </button>
        @endif
    </div>
    <hr>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-rank">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Pangkat</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.rankForm')

@endsection

@section('script')
<script>

    var table = $('#table-rank').DataTable({
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

    rankForm = function(id = null){
        var rankFormModal;
        rankFormModal = new bootstrap.Modal(document.getElementById('rankFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#rankForm').attr('action', '{{ route("admin.reference.rank.store") }}');
            $('#rankForm input[name="code"]').val("");
            $('#rankForm input[name="name"]').val("");

            $('#title-role').html('Tambah Pangkat');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            rankFormModal.show();
        }else{
            url = "{{ route('admin.reference.rank.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    rank_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.rank.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', rank_id);

                    $('#rankForm').attr('action',url2 );
                    $('#rankForm input[name="code"]').val(data.detail.code);
                    $('#rankForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Pangkat');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    rankFormModal.show();
                },
            });
        }
    };

</script>
@endsection
