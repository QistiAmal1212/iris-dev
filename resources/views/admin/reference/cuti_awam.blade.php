@extends('layouts.app')

@section('header')
    Cuti Awam
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Cuti Awam</a>
    </li>
@endsection

@section('content')
    <style>
        #table-cutiawam thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-cutiawam tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-cutiawam {
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
            <h4 class="card-title">Senarai Cuti Awam</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="cutiawamForm()">
                    <i class="fa-solid fa-add"></i> Tambah Cuti Awam
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label class="form-label" for="code">Carian Cuti</label>
                        <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                            <option value="Lihat Semua" selected>Lihat Semua</option>
                            @foreach ($senaraicuti as $cuti)
                            <option value="{{ $cuti->kod }}">{{ $cuti->kod }} - {{ $cuti->nama }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label class="form-label" for="code">Carian Negeri</label>
                        <select name="module_id" id="module_id" class="select2 form-control">
                            <option value="Lihat Semua" selected>Lihat Semua</option>
                            @foreach ($negeri as $neg)
                            <option value="{{ $neg->kod }}">{{ $neg->kod }} - {{ $neg->nama }} </option>
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
                <table class="table header_uppercase table-bordered" id="table-cutiawam">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Tarikh Cuti</th>
                            <th>Kod Cuti</th>
                            <th>Kod Negeri</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.cutiawamForm')
@endsection

@section('script')
    <script>
        var table = $('#table-cutiawam').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 25,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            ajax: {
                url: "{{ fullUrl() }}",
                cache: false,
            },
            columns: [{
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "kod",
                    name: "kod",
                    className: "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "tarikh_cuti",
                    name: "tarikh_cuti",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "kod_cuti",
                    name: "kod_cuti",
                    className: "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "kod_neg",
                    name: "kod_neg",
                    className: "text-center",
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
            language: {
                emptyTable: "Tiada data tersedia",
                info: "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
                infoEmpty: "Menunjukkan 0 hingga 0 daripada 0 entri",
                infoFiltered: "(Ditapis dari _MAX_ entri)",
                search: "Cari:",
                zeroRecords: "Tiada rekod yang ditemui",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Seterusnya",
                    previous: "Sebelumnya"
                },
                lengthMenu: "Lihat _MENU_ entri",
            }
        });

        $('body').on('submit','#form-search',function(e){

            e.preventDefault();

            var form = $("#form-search");

            if(!form.valid()){
                return false;
            }
            var table;

            table = $('#table-cutiawam').DataTable().destroy();

            table = $('#table-cutiawam').DataTable({
                orderCellsTop: true,
                colReorder: false,
                pageLength: 25,
                processing: true,
                serverSide: true, //enable if data is large (more than 50,000)
                deferRender: true,
                ajax: form.attr('action')+"?"+form.serialize(),
                columns: [{
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "kod",
                        name: "kod",
                        className: "text-center",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "tarikh_cuti",
                        name: "tarikh_cuti",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "kod_cuti",
                        name: "kod_cuti",
                        className: "text-center",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "kod_neg",
                        name: "kod_neg",
                        className: "text-center",
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
                language: {
                    emptyTable: "Tiada data tersedia",
                    info: "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
                    infoEmpty: "Menunjukkan 0 hingga 0 daripada 0 entri",
                    infoFiltered: "(Ditapis dari _MAX_ entri)",
                    search: "Cari:",
                    zeroRecords: "Tiada rekod yang ditemui",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Seterusnya",
                        previous: "Sebelumnya"
                    },
                    lengthMenu: "Lihat _MENU_ entri",
                }
            });
        });

        cutiawamForm = function(id = null) {
            var cutiawamFormModal;
            cutiawamFormModal = new bootstrap.Modal(document.getElementById('cutiawamFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#cutiawamForm').attr('action', '{{ route('admin.reference.cutiawam.store') }}');
                $('#cutiawamForm input[name="code"]').val("");
                $('#cutiawamForm input[name="tarikh_cuti"]').val("");
                $('#cutiawamForm select[name="kod_ruj_senarai_cuti"]').val("").trigger('change');
                $('#cutiawamForm select[name="kod_ruj_negeri"]').val("").trigger('change');
                $('#cutiawamForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Cuti Awam');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                cutiawamFormModal.show();
            } else {
                url = "{{ route('admin.reference.cutiawam.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        cutiawam_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.cutiawam.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', cutiawam_id);

                        $('#cutiawamForm').attr('action', url2);
                        $('#cutiawamForm input[name="code"]').val(data.detail.kod);
                        $('#cutiawamForm input[name="tarikh_cuti"]').val(data.detail.tarikh_cuti);
                        $('#cutiawamForm select[name="kod_ruj_senarai_cuti"]').val(data.detail.kod_ruj_senarai_cuti).trigger('change');
                        $('#cutiawamForm select[name="kod_ruj_negeri"]').val(data.detail.kod_ruj_negeri).trigger('change');

                        $('#cutiawamForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Cuti Awam');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        cutiawamFormModal.show();
                    },
                });
            }
        };

        function toggleActive(cutiawamId) {
            var url = "{{ route('admin.reference.cutiawam.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', cutiawamId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + cutiawamId + '"]');
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
