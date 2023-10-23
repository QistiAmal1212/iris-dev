@extends('layouts.app')

@section('header')
    Tawaran Kursus
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Tawaran Kursus</a>
    </li>
@endsection

@section('content')
    <style>
        #table-tawarankursus thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-tawarankursus tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-tawarankursus {
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
            <h4 class="card-title">Senarai Tawaran Kursus</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="tawarankursusForm()">
                    <i class="fa-solid fa-add"></i> Tambah Tawaran Kursus
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <form id="form-search" role="form" autocomplete="off" method="post" action="" class="mb-4" novalidate>
                <div class="row align-items-center">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label class="form-label" for="code">Carian Jenis</label>
                        <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                            <option value="Lihat Semua" selected>Lihat Semua</option>
                            @foreach ($jenis as $j)
                            <option value="{{ $j->kod }}">{{ $j->kod }} - {{ $j->diskripsi }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 mt-2">
                        <button type="submit" class="btn btn-success">
                          <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-tawarankursus">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="7%">Kod</th>
                            <th>Tawaran Kursus</th>
                            <th>Diskripsi</th>
                            <th>Jenis</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.tawarankursusForm')
@endsection

@section('script')
    <script>
        var table = $('#table-tawarankursus').DataTable({
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
                    data: "nama",
                    name: "nama",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "diskripsi",
                    name: "diskripsi",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "jenis",
                    name: "jenis",
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

            table = $('#table-tawarankursus').DataTable().destroy();

            table = $('#table-tawarankursus').DataTable({
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
                        data: "nama",
                        name: "nama",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "diskripsi",
                        name: "diskripsi",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "jenis",
                        name: "jenis",
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

        tawarankursusForm = function(id = null) {
            var tawarankursusFormModal;
            tawarankursusFormModal = new bootstrap.Modal(document.getElementById('tawarankursusFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#tawarankursusForm').attr('action', '{{ route('admin.reference.tawarankursus.store') }}');
                $('#tawarankursusForm input[name="code"]').val("");
                $('#tawarankursusForm input[name="name"]').val("");
                $('#tawarankursusForm select[name="jenis"]').val("");
                $('#tawarankursusForm textarea[name="diskripsi"]').val("");
                $('#tawarankursusForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Tawaran Kursus');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                tawarankursusFormModal.show();
            } else {
                url = "{{ route('admin.reference.tawarankursus.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        tawarankursus_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.tawarankursus.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', tawarankursus_id);

                        $('#tawarankursusForm').attr('action', url2);
                        $('#tawarankursusForm input[name="code"]').val(data.detail.kod);
                        $('#tawarankursusForm input[name="name"]').val(data.detail.diskripsi);
                        $('#tawarankursusForm select[name="jenis"]').val(data.detail.jenis).trigger('change');
                        $('#tawarankursusForm textarea[name="diskripsi"]').val(data.detail.diskripsi_penuh);

                        $('#tawarankursusForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Tawaran Kursus');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        tawarankursusFormModal.show();
                    },
                });
            }
        };

        function toggleActive(tawarankursusId) {
            var url = "{{ route('admin.reference.tawarankursus.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', tawarankursusId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + tawarankursusId + '"]');
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
