@extends('layouts.app')

@section('header')
    Jenis Pengalaman
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Jenis Pengalaman</a>
    </li>
@endsection

@section('content')
    <style>
        #table-pengalaman9 thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-pengalaman9 tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-pengalaman9 {
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
            <h4 class="card-title">Senarai Jenis Pengalaman</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="pengalaman9Form()">
                    <i class="fa-solid fa-add"></i> Tambah Jenis Pengalaman
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-pengalaman9">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Jenis Pengalaman</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.pengalaman9Form')
@endsection

@section('script')
    <script>
        var table = $('#table-pengalaman9').DataTable({
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

        pengalaman9Form = function(id = null) {
            var pengalaman9FormModal;
            pengalaman9FormModal = new bootstrap.Modal(document.getElementById('pengalaman9FormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#pengalaman9Form').attr('action', '{{ route('admin.reference.pengalaman9.store') }}');
                $('#pengalaman9Form input[name="code"]').val("");
                $('#pengalaman9Form input[name="name"]').val("");
                $('#pengalaman9Form input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Jenis Pengalaman');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                pengalaman9FormModal.show();
            } else {
                url = "{{ route('admin.reference.pengalaman9.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        pengalaman9_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.pengalaman9.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', pengalaman9_id);

                        $('#pengalaman9Form').attr('action', url2);
                        $('#pengalaman9Form input[name="code"]').val(data.detail.kod);
                        $('#pengalaman9Form input[name="name"]').val(data.detail.diskripsi);

                        $('#pengalaman9Form input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Jenis Pengalaman');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        pengalaman9FormModal.show();
                    },
                });
            }
        };

        function toggleActive(pengalaman9Id) {
            var url = "{{ route('admin.reference.pengalaman9.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', pengalaman9Id);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + pengalaman9Id + '"]');
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

        function deleteItem(pengalaman9Id){
        var url = "{{ route('admin.reference.pengalaman9.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', pengalaman9Id);

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
