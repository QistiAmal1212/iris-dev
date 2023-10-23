@extends('layouts.app')

@section('header')
    Kelayakan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Kelayakan</a>
    </li>
@endsection

@section('content')
    <style>
        #table-eligibility thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-eligibility tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-eligibility {
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
            <h4 class="card-title">Senarai Kelayakan</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="eligibilityForm()">
                    <i class="fa-solid fa-add"></i> Tambah Kelayakan
                </button>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <form id="form-search" role="form" autocomplete="off" method="post" action="" class="mb-4" novalidate>
                <div class="row align-items-center">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label class="form-label" for="code">Carian Kelayakan Setara</label>
                        <select name="activity_type_id" id="activity_type_id" class="select2 form-control">
                            <option value="Lihat Semua" selected>Lihat Semua</option>
                            @foreach ($kelayakanSetaraf as $ks)
                            <option value="{{ $ks->kod }}">{{ $ks->kod }} - {{ $ks->diskripsi }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 mt-2">
                        <button type="submit" class="btn btn-success">
                          <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-eligibility">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th>Nama</th>
                            <th>Kelayakan Setaraf</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.eligibilityForm')
@endsection

@section('script')
    <script>
        var table = $('#table-eligibility').DataTable({
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
                    data: "code",
                    name: "code",
                    className: "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "name",
                    name: "name",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "ks",
                    name: "ks",
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

        $('body').on('submit','#form-search',function(e){

            e.preventDefault();

            var form = $("#form-search");

            if(!form.valid()){
                return false;
            }
            var table;

            table = $('#table-eligibility').DataTable().destroy();

            table = $('#table-eligibility').DataTable({
                orderCellsTop: true,
                colReorder: false,
                pageLength: 25,
                processing: true,
                serverSide: true, //enable if data is large (more than 50,000)
                deferRender: true,
                ajax: form.attr('action')+"?"+form.serialize(),
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
                        data: "code",
                        name: "code",
                        className: "text-center",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "name",
                        name: "name",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "ks",
                        name: "ks",
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
            });

        eligibilityForm = function(id = null) {
            var eligibilityFormModal;
            eligibilityFormModal = new bootstrap.Modal(document.getElementById('eligibilityFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#eligibilityForm').attr('action', '{{ route("admin.reference.eligibility.store") }}');

                $('#eligibilityForm input[name="code"]').val("");
                $('#eligibilityForm input[name="name"]').val("");
                $('#eligibilityForm select[name="ref_skim_code"]').val("").trigger('change');
                $('#eligibilityForm select[name="equivalent"]').val("").trigger('change');
                $('#eligibilityForm input[name="rank"]').val("");
                $('#eligibilityForm input[name="code"]').prop('readonly', false);

                $('#title-role').html('Tambah Kelayakan');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                eligibilityFormModal.show();
            } else {
                url = "{{ route('admin.reference.eligibility.edit', ':replaceThis') }}"
                url = url.replace(':replaceThis', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        salary_grade_id = data.detail.id;
                        // console.log(id_used);
                        url2 = "{{ route('admin.reference.eligibility.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', salary_grade_id);

                        $('#eligibilityForm').attr('action', url2);
                        $('#eligibilityForm input[name="code"]').val(data.detail.kod);
                        $('#eligibilityForm input[name="name"]').val(data.detail.diskripsi);
                        $('#eligibilityForm select[name="ref_skim_code"]').val(data.detail.ski_kod).trigger('change');
                        $('#eligibilityForm select[name="equivalent"]').val(data.detail.kelayakan_setara).trigger('change');
                        $('#eligibilityForm input[name="rank"]').val(data.detail.rank_layak);
                        $('#eligibilityForm input[name="code"]').prop('readonly', true);

                        $('#title-role').html('Kemaskini Kelayakan');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        eligibilityFormModal.show();
                    },
                });
            }
        };

        function toggleActive(eligibilityId) {
            var url = "{{ route('admin.reference.eligibility.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', eligibilityId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + eligibilityId + '"]');
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

        function deleteItem(eligibilityId){
        var url = "{{ route('admin.reference.eligibility.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', eligibilityId);

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
