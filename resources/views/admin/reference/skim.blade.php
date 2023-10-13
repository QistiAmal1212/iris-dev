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
<style>
    #table-skim thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-skim tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-skim {
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
        <h4 class="card-title">Senarai Skim Jawatan</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="skimForm()">
            <i class="fa-solid fa-add"></i> Tambah Jawatan
        </button>
        @endif
    </div>
    <hr>
    <div class="card-body">
        <form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label class="form-label" for="code">Carian JKK</label>
                    <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                        <option value="Lihat Semua" selected>Lihat Semua</option>
                        @foreach ($kump_jkk as $kump)
                        <option value="{{ $kump->kod }}">{{ $kump->kod }} - {{ $kump->diskripsi }}</option>
                        @endforeach
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
            <table class="table header_uppercase table-bordered" id="table-skim">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Skim Jawatan</th>
                        <th width="10%">Gred Gaji</th>
                        <th width="10%">KUmpulan JKK</th>
                        <th width="10%">Tindakan</th>
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
                data: "ggh",
                name: "ggh",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "jkk",
                name: "jkk",
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

        table = $('#table-skim').DataTable().destroy();

        table = $('#table-skim').DataTable({
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
                    data: "ggh",
                    name: "ggh",
                    className : "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "jkk",
                    name: "jkk",
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

    skimForm = function(id = null){
        var skimFormModal;
        skimFormModal = new bootstrap.Modal(document.getElementById('skimFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#skimForm').attr('action', '{{ route("admin.reference.skim.store") }}');
            $('#skimForm input[name="code"]').val("");
            $('#skimForm input[name="name"]').val("");
            $('#skimForm input[name="GUNASAMA"]').val("");
            $('#skimForm input[name="ref_skim_type"]').val("");
            $('#skimForm select[name="GGH_KOD"]').val("").trigger('change');
            $('#skimForm select[name="SKIM_PKHIDMAT"]').val("").trigger('change');
            $('#skimForm select[name="KUMP_PKHIDMAT_JKK"]').val("").trigger('change');
            $('#skimForm input[name="code"]').prop('readonly', false);

            $('#title-role').html('Tambah Jawatan');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            skimFormModal.show();
        }else{
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
                    $('#skimForm input[name="code"]').val(data.detail.kod);
                    $('#skimForm input[name="name"]').val(data.detail.diskripsi);
                    $('#skimForm input[name="GUNASAMA"]').val(data.detail.GUNASAMA);
                    $('#skimForm input[name="ref_skim_type"]').val(data.detail.jenis_skim);
                    $('#skimForm select[name="GGH_KOD"]').val(data.detail.GGH_KOD).trigger('change');
                    $('#skimForm select[name="SKIM_PKHIDMAT"]').val(data.detail.SKIM_PKHIDMAT).trigger('change');
                    $('#skimForm select[name="KUMP_PKHIDMAT_JKK"]').val(data.detail.KUMP_PKHIDMAT_JKK).trigger('change');

                    $('#skimForm input[name="code"]').prop('readonly', true);

                    $('#title-role').html('Kemaskini Jawatan');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    skimFormModal.show();
                },
            });
        }
    };

    function toggleActive(skimId) {
            var url = "{{ route('admin.reference.skim.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', skimId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + skimId + '"]');
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
