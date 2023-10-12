@extends('layouts.app')

@section('header')
    Skim Kumpulan Perkhidmatan C
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Skim Kumpulan Perkhidmatan C</a>
    </li>
@endsection

@section('content')
    <style>
        #table-jkkc thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-jkkc tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-jkkc {
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
            <h4 class="card-title">Senarai Skim Kumpulan Perkhidmatan C</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="jkkcForm()">
                    <i class="fa-solid fa-add"></i> Tambah Skim Kumpulan Perkhidmatan C
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-jkkc">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th>Kod Skim Kumpulan Perkhidmatan C</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.jkkcForm')
@endsection

@section('script')
    <script>
        var table = $('#table-jkkc').DataTable({
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

        jkkcForm = function(id = null) {
            var jkkcFormModal;
            jkkcFormModal = new bootstrap.Modal(document.getElementById('jkkcFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#jkkcForm').attr('action', '{{ route('admin.reference.jkkc.store') }}');
                $('#jkkcForm input[name="code"]').val("");
                // $('#jkkcForm input[name="name"]').val("");
                $('#jkkcForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Skim Kumpulan Perkhidmatan C');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                jkkcFormModal.show();
            } else {
                url = "{{ route('admin.reference.jkkc.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        jkkc_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.jkkc.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', jkkc_id);

                        $('#jkkcForm').attr('action', url2);
                        $('#jkkcForm input[name="code"]').val(data.detail.ski_kod);
                        // $('#jkkcForm input[name="name"]').val(data.detail.nama);

                        $('#jkkcForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Skim Kumpulan Perkhidmatan C');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        jkkcFormModal.show();
                    },
                });
            }
        };

        function toggleActive(jkkcId) {
            var url = "{{ route('admin.reference.jkkc.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', jkkcId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + jkkcId + '"]');
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
