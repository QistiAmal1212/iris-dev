@extends('layouts.app')

@section('header')
    Jawatan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Jawatan</a>
    </li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Jawatan</h4>
        <button type="button" class="btn btn-success btn-sm float-right" onclick="skimForm()">
            <i class="fa-solid fa-add"></i> Tambah Jawatan
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-skim">
                <thead>
                    <tr>
                        <th bgcolor="#f0f0f0" class="fit align-top text-left" style="color:#000">#</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Kod</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Nama Jawatan</th>
                        <th bgcolor="#f0f0f0" class="align-top text-left" style="color:#000">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.skimForm')

@endsection

@section('script')
<script>

    var table = $('#table-skim').DataTable({
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

    skimForm = function(id = null){
        var skimFormModal;
        skimFormModal = new bootstrap.Modal(document.getElementById('skimFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#skimForm').attr('action', '{{ route("admin.reference.skim.store") }}');
            $('#skimForm input[name="code"]').val("");
            $('#skimForm input[name="name"]').val("");

            $('#title-role').html('Tambah Jawatan');

            skimFormModal.show();
        }else{
            console.log(id);
            url = "{{ route('admin.reference.skim.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    skim_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.skim.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', skim_id);

                    $('#skimForm').attr('action',url2 );
                    $('#skimForm input[name="code"]').val(data.detail.code);
                    $('#skimForm input[name="name"]').val(data.detail.name);

                    $('#title-role').html('Kemaskini Jawatan');

                    skimFormModal.show();
                },
            });
        }
    };

</script>
@endsection