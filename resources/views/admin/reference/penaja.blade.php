@extends('layouts.app')

@section('header')
    Penaja
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Penaja</a>
    </li>
@endsection

@section('content')
    <style>
        #table-penaja thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-penaja tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-penaja {
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
            <h4 class="card-title">Senarai Penaja</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="penajaForm()">
                    <i class="fa-solid fa-add"></i> Tambah Penaja
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label class="form-label" for="code">Carian Jenis Penaja</label>
                        <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                            <option value="Lihat Semua" selected>Lihat Semua</option>
                            @foreach ($jenis as $type)
                            <option value="{{ $type->kod }}">{{ $type->kod }} - {{ $type->diskripsi }}</option>
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
                <table class="table header_uppercase table-bordered" id="table-penaja">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Penaja</th>
                            <th>Jenis</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.penajaForm')
@endsection

@section('script')
    <script>
        var table = $('#table-penaja').DataTable({
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
                    data: "jenis",
                    name: "jenis",
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

            table = $('#table-penaja').DataTable().destroy();

            table = $('#table-penaja').DataTable({
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
                        data: "jenis",
                        name: "jenis",
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

        penajaForm = function(id = null) {
            var penajaFormModal;
            penajaFormModal = new bootstrap.Modal(document.getElementById('penajaFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#penajaForm').attr('action', '{{ route('admin.reference.penaja.store') }}');
                $('#penajaForm input[name="code"]').val("");
                $('#penajaForm input[name="name"]').val("");
                $('#penajaForm select[name="jenis"]').val("").trigger('change');
                $('#penajaForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Penaja');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                penajaFormModal.show();
            } else {
                url = "{{ route('admin.reference.penaja.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        penaja_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.penaja.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', penaja_id);

                        $('#penajaForm').attr('action', url2);
                        $('#penajaForm input[name="code"]').val(data.detail.kod);
                        $('#penajaForm input[name="name"]').val(data.detail.diskripsi);
                        $('#penajaForm select[name="jenis"]').val(data.detail.jenis).trigger('change');

                        $('#penajaForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Penaja');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        penajaFormModal.show();
                    },
                });
            }
        };

        function toggleActive(penajaId) {
            var url = "{{ route('admin.reference.penaja.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', penajaId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + penajaId + '"]');
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
