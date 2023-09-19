@extends('layouts.app')

@section('header')
    Butiran Gred Gaji
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a>Butiran Gred Gaji</a>
    </li>
@endsection

@section('content')
    <style>
        #table-salary-grade-details thead th {
            vertical-align: middle;
            text-align: center;
        }

        #table-salary-grade-details tbody {
            vertical-align: middle;
            /* text-align: center; */
        }

        #table-salary-grade-details {
            width: 100% !important;
            /* word-wrap: break-word; */
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Senarai Butiran Gred Gaji</h4>
            @if ($accessAdd)
                <button type="button" class="btn btn-primary btn-md float-right" onclick="salaryGradeDetailsForm()">
                    <i class="fa-solid fa-add"></i> Tambah Butiran Gred Gaji
                </button>
            @endif
        </div>
        <hr>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-salary-grade-details">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Kod</th>
                            <th width="15%">Tahap</th>
                            <th width="15%">Tahun</th>
                            <th>Jumlah</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.reference.salaryGradeDetailsForm')
    @include('admin.reference.salaryGradeDetailsEditForm')
@endsection

@section('script')
    <script>
        var table = $('#table-salary-grade-details').DataTable({
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
                    data: "ref_salary_grade_code",
                    name: "ref_salary_grade_code",
                    className: "text-center",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "level",
                    name: "level",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "year",
                    name: "year",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "amount",
                    name: "amount",
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

        salaryGradeDetailsForm = function(id = null) {
            var salaryGradeDetailsFormModal;
            salaryGradeDetailsFormModal = new bootstrap.Modal(document.getElementById('salaryGradeDetailsFormModal'), {
                keyboard: false
            });

            var accessAdd = '{{ $accessAdd }}';
            var accessUpdate = '{{ $accessUpdate }}';

            event.preventDefault();
            if (id === null) {
                $('#salaryGradeDetailsForm').attr('action',
                    '{{ route('admin.reference.salary-grade-details.store') }}');

                $('#salaryGradeDetailsForm input[name="code"]').val("");
                $('#salaryGradeDetailsForm input[name="level"]').val("");
                $('#salaryGradeDetailsForm input[name="year"]').val("");
                $('#salaryGradeDetailsForm input[name="amount"]').val("");

                $('#title-role').html('Tambah Butiran Gred Gaji');

                if (accessAdd == '') {
                    $('#btn_fake').attr('hidden', true);
                } else if (accessAdd != '') {
                    $('#btn_fake').attr('hidden', false);
                }

                salaryGradeDetailsFormModal.show();
            } else {
                salaryGradeDetailsFormModal = new bootstrap.Modal(document.getElementById(
                    'salaryGradeDetailsEditFormModal'), {
                        keyboard: false
                    });
                url = "{{ route('admin.reference.salary-grade-details.edit', ':replaceThis') }}"
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
                        url2 = "{{ route('admin.reference.salary-grade-details.update', ':replaceThis') }}"
                        url2 = url2.replace(':replaceThis', salary_grade_id);

                        $('#salaryGradeDetailsForm').attr('action', url2);
                        $('#salaryGradeDetailsForm input[name="code"]').val(data.detail.ref_salary_grade_code);
                        $('#salaryGradeDetailsForm input[name="level"]').val(data.detail.level);
                        $('#salaryGradeDetailsForm input[name="year"]').val(data.detail.year);
                        $('#salaryGradeDetailsForm input[name="amount"]').val(data.detail.amount);

                        $('#salaryGradeDetailsForm input[name="code"]').prop('readonly', true);

                        $('#salaryGradeDetailsForm input[name="code"]').css({
                            'background-color': '#f0f0f0',
                            'color': '#666',
                            'border': '1px solid #ccc',
                            'cursor': 'not-allowed'
                        });

                        $('#title-role').html('Kemaskini Butiran Gred Gaji');

                        if (accessUpdate == '') {
                            $('#btn_fake').attr('hidden', true);
                        } else if (accessUpdate != '') {
                            $('#btn_fake').attr('hidden', false);
                        }

                        salaryGradeDetailsFormModal.show();
                    },
                });
            }
        };

        function toggleActive(salaryGradeDetailsId) {
            var url = "{{ route('admin.reference.salary-grade-details.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', salaryGradeDetailsId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + salaryGradeDetailsId + '"]');
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
