@extends('layouts.app')

@section('header')
    Bahagian
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Bahagian</a>
    </li>
@endsection

@section('content')
    <style>
        #table-bahagian thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-bahagian tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-bahagian {
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
            <h4 class="card-title">Senarai Bahagian</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="bahagianForm()">
                    <i class="fa-solid fa-add"></i> Tambah Bahagian
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-bahagian">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Bahagian</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.bahagianForm')
@endsection

@section('script')
    <script>
        var table = $('#table-bahagian').DataTable({
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

        bahagianForm = function(id = null) {
            var bahagianFormModal;
            bahagianFormModal = new bootstrap.Modal(document.getElementById('bahagianFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#bahagianForm').attr('action', '{{ route('admin.reference.bahagian.store') }}');
                $('#bahagianForm input[name="code"]').val("");
                $('#bahagianForm input[name="name"]').val("");
                $('#bahagianForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Bahagian');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                bahagianFormModal.show();
            } else {
                url = "{{ route('admin.reference.bahagian.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        bahagian_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.bahagian.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', bahagian_id);

                        $('#bahagianForm').attr('action', url2);
                        $('#bahagianForm input[name="code"]').val(data.detail.kod);
                        $('#bahagianForm input[name="name"]').val(data.detail.diskripsi);

                        $('#bahagianForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Bahagian');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        bahagianFormModal.show();
                    },
                });
            }
        };

        function toggleActive(bahagianId) {
            var url = "{{ route('admin.reference.bahagian.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', bahagianId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + bahagianId + '"]');
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
        function deleteItem(bahagianId){
        var url = "{{ route('admin.reference.bahagian.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', bahagianId);

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
