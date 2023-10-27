@extends('layouts.app')

@section('header')
    Penjelasan Urusan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Penjelasan Urusan</a>
    </li>
@endsection

@section('content')
    <style>
        #table-jelasurusan thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-jelasurusan tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-jelasurusan {
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
            <h4 class="card-title">Senarai Penjelasan Urusan</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="jelasurusanForm()">
                    <i class="fa-solid fa-add"></i> Tambah Penjelasan Urusan
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-jelasurusan">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Penjelasan Urusan</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.jelasurusanForm')
@endsection

@section('script')
    <script>
        var table = $('#table-jelasurusan').DataTable({
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

        jelasurusanForm = function(id = null) {
            var jelasurusanFormModal;
            jelasurusanFormModal = new bootstrap.Modal(document.getElementById('jelasurusanFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#jelasurusanForm').attr('action', '{{ route('admin.reference.jelasurusan.store') }}');
                $('#jelasurusanForm input[name="code"]').val("");
                $('#jelasurusanForm input[name="name"]').val("");
                $('#jelasurusanForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Penjelasan Urusan');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                jelasurusanFormModal.show();
            } else {
                url = "{{ route('admin.reference.jelasurusan.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        jelasurusan_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.jelasurusan.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', jelasurusan_id);

                        $('#jelasurusanForm').attr('action', url2);
                        $('#jelasurusanForm input[name="code"]').val(data.detail.kod);
                        $('#jelasurusanForm input[name="name"]').val(data.detail.diskripsi);

                        $('#jelasurusanForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Penjelasan Urusan');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        jelasurusanFormModal.show();
                    },
                });
            }
        };

        function toggleActive(jelasurusanId) {
            var url = "{{ route('admin.reference.jelasurusan.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', jelasurusanId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + jelasurusanId + '"]');
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

        function deleteItem(jelasurusanId){
        var url = "{{ route('admin.reference.jelasurusan.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', jelasurusanId);

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
