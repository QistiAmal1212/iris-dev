@extends('layouts.app')

@section('header')
    Status
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Status</a>
    </li>
@endsection

@section('content')
    <style>
        #table-status thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-status tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-status {
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
            <h4 class="card-title">Senarai Status</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="statusForm()">
                    <i class="fa-solid fa-add"></i> Tambah Status
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-status">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Status</th>
                            <th>Diskripsi</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.statusForm')
@endsection

@section('script')
    <script>
        var table = $('#table-status').DataTable({
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

        statusForm = function(id = null) {
            var statusFormModal;
            statusFormModal = new bootstrap.Modal(document.getElementById('statusFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#statusForm').attr('action', '{{ route('admin.reference.status.store') }}');
                $('#statusForm input[name="code"]').val("");
                $('#statusForm input[name="name"]').val("");
                $('#statusForm input[name="diskripsi"]').val("");
                $('#statusForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Status');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                statusFormModal.show();
            } else {
                url = "{{ route('admin.reference.status.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        status_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.status.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', status_id);

                        $('#statusForm').attr('action', url2);
                        $('#statusForm input[name="code"]').val(data.detail.kod);
                        $('#statusForm input[name="name"]').val(data.detail.diskripsi);
                        $('#statusForm input[name="diskripsi"]').val(data.detail.diskripsi2);

                        $('#statusForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Status');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        statusFormModal.show();
                    },
                });
            }
        };

        function toggleActive(statusId) {
            var url = "{{ route('admin.reference.status.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', statusId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + statusId + '"]');
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

        function deleteItem(statusId){
        var url = "{{ route('admin.reference.status.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', statusId);

        Swal.fire({
            title: 'Adakah anda ingin hapuskan maklumat ini?',
            showCancelButton: true,
            confirmButtonText: 'Sahkan',
            cancelButtonText: 'Batal',
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    async: true,
                    success: function(data){
                        table.draw();
                    }
                })
            }
        })

        }
    </script>
@endsection
