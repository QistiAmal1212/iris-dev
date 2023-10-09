@extends('layouts.app')

@section('header')
    Klasifikasi Perkhidmatan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Klasifikasi Perkhidmatan</a>
    </li>
@endsection

@section('content')
    <style>
        #table-klasifikasiperkhidmatan thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-klasifikasiperkhidmatan tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-klasifikasiperkhidmatan {
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
            <h4 class="card-title">Senarai Klasifikasi Perkhidmatan</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="klasifikasiperkhidmatanForm()">
                    <i class="fa-solid fa-add"></i> Tambah Klasifikasi Perkhidmatan
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-klasifikasiperkhidmatan">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Klasifikasi Perkhidmatan</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.klasifikasiperkhidmatanForm')
@endsection

@section('script')
    <script>
        var table = $('#table-klasifikasiperkhidmatan').DataTable({
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

        klasifikasiperkhidmatanForm = function(id = null) {
            var klasifikasiperkhidmatanFormModal;
            klasifikasiperkhidmatanFormModal = new bootstrap.Modal(document.getElementById('klasifikasiperkhidmatanFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#klasifikasiperkhidmatanForm').attr('action', '{{ route('admin.reference.klasifikasiperkhidmatan.store') }}');
                $('#klasifikasiperkhidmatanForm input[name="code"]').val("");
                $('#klasifikasiperkhidmatanForm input[name="name"]').val("");
                $('#klasifikasiperkhidmatanForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Klasifikasi Perkhidmatan');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                klasifikasiperkhidmatanFormModal.show();
            } else {
                url = "{{ route('admin.reference.klasifikasiperkhidmatan.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        klasifikasiperkhidmatan_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.klasifikasiperkhidmatan.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', klasifikasiperkhidmatan_id);

                        $('#klasifikasiperkhidmatanForm').attr('action', url2);
                        $('#klasifikasiperkhidmatanForm input[name="code"]').val(data.detail.kod);
                        $('#klasifikasiperkhidmatanForm input[name="name"]').val(data.detail.nama);

                        $('#klasifikasiperkhidmatanForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Klasifikasi Perkhidmatan');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        klasifikasiperkhidmatanFormModal.show();
                    },
                });
            }
        };

        function toggleActive(klasifikasiperkhidmatanId) {
            var url = "{{ route('admin.reference.klasifikasiperkhidmatan.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', klasifikasiperkhidmatanId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + klasifikasiperkhidmatanId + '"]');
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
