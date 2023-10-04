@extends('layouts.app')

@section('header')
    Negeri JPN
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Negeri JPN</a>
    </li>
@endsection

@section('content')
    <style>
        #table-negerijpn thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-negerijpn tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-negerijpn {
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
            <h4 class="card-title">Senarai Negeri JPN</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="negerijpnForm()">
                    <i class="fa-solid fa-add"></i> Tambah Negeri JPN
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-negerijpn">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Negeri JPN</th>
                            <th width="15%">Kod Negeri</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.negerijpnForm')
@endsection

@section('script')
    <script>
        var table = $('#table-negerijpn').DataTable({
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
                    data: "kod_neg",
                    name: "kod_neg",
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

        negerijpnForm = function(id = null) {
            var negerijpnFormModal;
            negerijpnFormModal = new bootstrap.Modal(document.getElementById('negerijpnFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#negerijpnForm').attr('action', '{{ route('admin.reference.negerijpn.store') }}');
                $('#negerijpnForm input[name="code"]').val("");
                $('#negerijpnForm input[name="name"]').val("");
                $('#negerijpnForm select[name="kod_ruj_negeri"]').val("").trigger('change');
                $('#negerijpnForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Negeri JPN');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                negerijpnFormModal.show();
            } else {
                url = "{{ route('admin.reference.negerijpn.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        negerijpn_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.negerijpn.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', negerijpn_id);

                        $('#negerijpnForm').attr('action', url2);
                        $('#negerijpnForm input[name="code"]').val(data.detail.kod);
                        $('#negerijpnForm input[name="name"]').val(data.detail.nama);
                        $('#negerijpnForm select[name="kod_ruj_negeri"]').val(data.detail.kod_ruj_negeri).trigger('change');

                        $('#negerijpnForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Negeri JPN');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        negerijpnFormModal.show();
                    },
                });
            }
        };

        function toggleActive(negerijpnId) {
            var url = "{{ route('admin.reference.negerijpn.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', negerijpnId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + negerijpnId + '"]');
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
