@extends('layouts.app')

@section('header')
    Biasiswa
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Biasiswa</a>
    </li>
@endsection

@section('content')
    <style>
        #table-biasiswa thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-biasiswa tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-biasiswa {
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
            <h4 class="card-title">Senarai Biasiswa</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="biasiswaForm()">
                    <i class="fa-solid fa-add"></i> Tambah Biasiswa
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-biasiswa">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Biasiswa</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.biasiswaForm')
@endsection

@section('script')
    <script>
        var table = $('#table-biasiswa').DataTable({
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

        biasiswaForm = function(id = null) {
            var biasiswaFormModal;
            biasiswaFormModal = new bootstrap.Modal(document.getElementById('biasiswaFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#biasiswaForm').attr('action', '{{ route('admin.reference.biasiswa.store') }}');
                $('#biasiswaForm input[name="code"]').val("");
                $('#biasiswaForm input[name="name"]').val("");
                $('#biasiswaForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Biasiswa');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                biasiswaFormModal.show();
            } else {
                url = "{{ route('admin.reference.biasiswa.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        biasiswa_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.biasiswa.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', biasiswa_id);

                        $('#biasiswaForm').attr('action', url2);
                        $('#biasiswaForm input[name="code"]').val(data.detail.kod);
                        $('#biasiswaForm input[name="name"]').val(data.detail.diskripsi);

                        $('#biasiswaForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Biasiswa');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        biasiswaFormModal.show();
                    },
                });
            }
        };

        function toggleActive(biasiswaId) {
            var url = "{{ route('admin.reference.biasiswa.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', biasiswaId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + biasiswaId + '"]');
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
        function deleteItem(biasiswaId){
        var url = "{{ route('admin.reference.biasiswa.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', biasiswaId);

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
