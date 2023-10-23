@extends('layouts.app')

@section('header')
    Ahli Suruhanjaya
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Ahli Suruhanjaya</a>
    </li>
@endsection

@section('content')
    <style>
        #table-ahlisuruhanjaya thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-ahlisuruhanjaya tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-ahlisuruhanjaya {
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
            <h4 class="card-title">Senarai Ahli Suruhanjaya</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="ahlisuruhanjayaForm()">
                    <i class="fa-solid fa-add"></i> Tambah Ahli Suruhanjaya
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-ahlisuruhanjaya">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Ahli Suruhanjaya</th>
                            <th>No. Kad Pengenalan</th>
                            <th>No. Telefon</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.ahlisuruhanjayaForm')
@endsection

@section('script')
    <script>
        var table = $('#table-ahlisuruhanjaya').DataTable({
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
                    data: "no_kp",
                    name: "no_kp",
                    className: "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "no_tel",
                    name: "no_tel",
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

        ahlisuruhanjayaForm = function(id = null) {
            var ahlisuruhanjayaFormModal;
            ahlisuruhanjayaFormModal = new bootstrap.Modal(document.getElementById('ahlisuruhanjayaFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#ahlisuruhanjayaForm').attr('action', '{{ route('admin.reference.ahlisuruhanjaya.store') }}');
                $('#ahlisuruhanjayaForm input[name="code"]').val("");
                $('#ahlisuruhanjayaForm input[name="name"]').val("");
                $('#ahlisuruhanjayaForm input[name="no_kp"]').val("");
                $('#ahlisuruhanjayaForm input[name="no_tel"]').val("");
                $('#ahlisuruhanjayaForm input[name="kekananan"]').val("");
                $('#ahlisuruhanjayaForm input[name="nama_pasangan"]').val("");
                $('#ahlisuruhanjayaForm input[name="no_tel_pasangan"]').val("");
                $('#ahlisuruhanjayaForm input[name="alamat1"]').val("");
                $('#ahlisuruhanjayaForm input[name="alamat2"]').val("");
                $('#ahlisuruhanjayaForm input[name="alamat3"]').val("");
                $('#ahlisuruhanjayaForm input[name="elaun_pada_gred"]').val("");
                $('#ahlisuruhanjayaForm input[name="kontrak_dari1"]').val("");
                $('#ahlisuruhanjayaForm input[name="kontrak_hingga1"]').val("");
                $('#ahlisuruhanjayaForm select[name="status_ahli"]').val("").trigger('change');
                $('#ahlisuruhanjayaForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Ahli Suruhanjaya');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                ahlisuruhanjayaFormModal.show();
            } else {
                url = "{{ route('admin.reference.ahlisuruhanjaya.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        ahlisuruhanjaya_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.ahlisuruhanjaya.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', ahlisuruhanjaya_id);

                        $('#ahlisuruhanjayaForm').attr('action', url2);
                        $('#ahlisuruhanjayaForm input[name="code"]').val(data.detail.kod);
                        $('#ahlisuruhanjayaForm input[name="name"]').val(data.detail.nama);
                        $('#ahlisuruhanjayaForm input[name="no_kp"]').val(data.detail.no_kp);
                        $('#ahlisuruhanjayaForm input[name="no_tel"]').val(data.detail.no_telefon);
                        $('#ahlisuruhanjayaForm input[name="kekananan"]').val(data.detail.kekananan);
                        $('#ahlisuruhanjayaForm input[name="nama_pasangan"]').val(data.detail.nama_pasangan);
                        $('#ahlisuruhanjayaForm input[name="no_tel_pasangan"]').val(data.detail.no_telefon_pasangan);
                        $('#ahlisuruhanjayaForm input[name="alamat1"]').val(data.detail.alamat1);
                        $('#ahlisuruhanjayaForm input[name="alamat2"]').val(data.detail.alamat2);
                        $('#ahlisuruhanjayaForm input[name="alamat3"]').val(data.detail.alamat3);
                        $('#ahlisuruhanjayaForm input[name="elaun_pada_gred"]').val(data.detail.elaun_pada_gred);
                        $('#ahlisuruhanjayaForm input[name="kontrak_dari1"]').val(data.detail.kontrak_dari1);
                        $('#ahlisuruhanjayaForm input[name="kontrak_hingga1"]').val(data.detail.kontrak_hingga1);
                        $('#ahlisuruhanjayaForm select[name="status_ahli"]').val(data.detail.status_ahli).trigger('change');

                        $('#ahlisuruhanjayaForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Ahli Suruhanjaya');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        ahlisuruhanjayaFormModal.show();
                    },
                });
            }
        };

        function toggleActive(ahlisuruhanjayaId) {
            var url = "{{ route('admin.reference.ahlisuruhanjaya.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', ahlisuruhanjayaId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + ahlisuruhanjayaId + '"]');
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

        function deleteItem(ahlisuruhanjayaId){
        var url = "{{ route('admin.reference.ahlisuruhanjaya.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', ahlisuruhanjayaId);

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
