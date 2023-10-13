@extends('layouts.app')

@section('header')
    Senarai Cuti
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Senarai Cuti</a>
    </li>
@endsection

@section('content')
    <style>
        #table-senaraicuti thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-senaraicuti tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-senaraicuti {
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
            <h4 class="card-title">Senarai Senarai Cuti</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="senaraicutiForm()">
                    <i class="fa-solid fa-add"></i> Tambah Senarai Cuti
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-senaraicuti">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Senarai Cuti</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.senaraicutiForm')
@endsection

@section('script')
    <script>
        var table = $('#table-senaraicuti').DataTable({
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

        senaraicutiForm = function(id = null) {
            var senaraicutiFormModal;
            senaraicutiFormModal = new bootstrap.Modal(document.getElementById('senaraicutiFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#senaraicutiForm').attr('action', '{{ route('admin.reference.senaraicuti.store') }}');
                $('#senaraicutiForm input[name="code"]').val("");
                $('#senaraicutiForm input[name="name"]').val("");
                $('#senaraicutiForm input[name="kategori"]').val("");
                $('#senaraicutiForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Senarai Cuti');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                senaraicutiFormModal.show();
            } else {
                url = "{{ route('admin.reference.senaraicuti.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        senaraicuti_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.senaraicuti.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', senaraicuti_id);

                        $('#senaraicutiForm').attr('action', url2);
                        $('#senaraicutiForm input[name="code"]').val(data.detail.kod);
                        $('#senaraicutiForm input[name="name"]').val(data.detail.diskripsi);
                        $('#senaraicutiForm input[name="kategori"]').val(data.detail.kategori);

                        $('#senaraicutiForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Senarai Cuti');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        senaraicutiFormModal.show();
                    },
                });
            }
        };

        function toggleActive(senaraicutiId) {
            var url = "{{ route('admin.reference.senaraicuti.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', senaraicutiId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + senaraicutiId + '"]');
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
