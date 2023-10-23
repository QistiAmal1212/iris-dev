<div class="modal fade text-start" id="salaryGradeFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Gred Gaji</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showPreviousPage()"></button>
            </div>
            <div class="modal-body" id="page1">
                <form action="{{ route('admin.reference.salary-grade.store') }}" method="POST" id="salaryGradeForm" data-reloadPage="true">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Kod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="code" name="code" value="" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="name">Gred Gaji
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" id="lihat-semua" class="btn btn-success mb-1" data-gred="" onclick="getListGredGaji($('#lihat-semua').data('gred'))" hidden>
                                Lihat Senarai Butiran
                            </button>
                        </div>
                    </div>
                    <button type="button" id="btn_submit" hidden onclick="generalFormSubmit(this);"></button>
                </form>
                <div class="modal-footer">
                    <button type="button" id="btn_fake" class="btn btn-primary" onclick="$('#btn_submit').trigger('click');">
                        Simpan
                    </button>
                </div>
                <div class="table-responsive m-lg-1" id="hide-table" hidden>
                    <table class="table header_uppercase table-bordered" id="table-salary-grade-details">
                        <thead>
                            <tr>
                                <th width="2%" class="text-center">No.</th>
                                <th width="15%" class="text-center">Tahap</th>
                                <th width="15%" class="text-center">Tahun</th>
                                <th class="text-center">Jumlah</th>
                                <th width="10%" class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @if($accessAdd)
                    <button type="button" class="btn btn-primary btn-md float-right" data-gred1="" onclick="showNextPage()">
                        <i class="fa-solid fa-add"></i> Tambah Butiran
                    </button>
                    @endif
                </div>
            </div>
            <div class="modal-body" id="page2" style="display:none;">
                <button type="button" class="btn btn-primary mb-2" onclick="showPreviousPage()">< Back</button>
                <form action="{{ route('admin.reference.salary-grade-details.store') }}" method="POST"
                    id="salaryGradeDetailsForm" data-reloadPage="true">
                    @csrf
                    <div class="row">
                        <input type="text" name="kod" id="kod" value="" hidden>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="level">Tahap
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="level" name="level" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="year">Tahun
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="year" name="year" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="amount">Jumlah
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="amount" name="amount" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btn_submit2" hidden onclick="generalFormSubmit(this);showPreviousPage();"></button>
                </form>
                <div class="modal-footer">
                    <button type="button" id="btn_fake2" class="btn btn-primary"
                        onclick="$('#btn_submit2').trigger('click');">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getListGredGaji(kod){
        var gghUrl = "{{ route('admin.reference.salary-grade.getList', ':replaceThis') }}"
        gghUrl = gghUrl.replace(':replaceThis', kod);

        var table;

        table = $('#table-salary-grade-details').DataTable().destroy();

        var ShowTable = $("#hide-table");
        ShowTable.removeAttr("hidden");

        var table = $('#table-salary-grade-details').DataTable({
                orderCellsTop: true,
                colReorder: false,
                pageLength: 10,
                processing: true,
                serverSide: true, //enable if data is large (more than 50,000)
                deferRender: true,
                ajax: {
                    url: gghUrl,
                    type: 'GET',
                    data: function (d) {
                        d.kod = 'kod';
                    }
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
    }

    function toggleActiveSGD(salaryGradeDetailsId) {
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

        showNextPage= function(id = null){

        $('#page1').hide();
        $('#page2').show();

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if (id === null) {
            var modalTitle = $('#title-role');
            modalTitle.text('Tambah Butiran Gred Gaji');

            $('#salaryGradeDetailsForm').attr('action',
            '{{ route('admin.reference.salary-grade-details.store') }}');

            $('#salaryGradeDetailsForm input[name="level"]').val("");
            $('#salaryGradeDetailsForm input[name="year"]').val("");
            $('#salaryGradeDetailsForm input[name="amount"]').val("");

            $('#title-role').html('Tambah Butiran Gred Gaji');

            if (accessAdd == '') {
                $('#btn_fake2').attr('hidden', true);
            } else if (accessAdd != '') {
                $('#btn_fake2').attr('hidden', false);
            }
        }else{
            var modalTitle = $('#title-role');
            modalTitle.text('Kemaskini Butiran Gred Gaji');
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

                    $('#salaryGradeDetailsForm input[name="level"]').val(data.detail.peringkat);
                    $('#salaryGradeDetailsForm input[name="year"]').val(data.detail.tahun);
                    $('#salaryGradeDetailsForm input[name="amount"]').val(data.detail.amaun);

                    $('#title-role').html('Kemaskini Butiran Gred Gaji');

                    if (accessUpdate == '') {
                        $('#btn_fake2').attr('hidden', true);
                    } else if (accessUpdate != '') {
                        $('#btn_fake2').attr('hidden', false);
                    }
                },
            });
        }



    }

    function deleteItemSGD(salaryGradeDetailsId){
        var url = "{{ route('admin.reference.salary-grade-details.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', salaryGradeDetailsId);

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
                        getListGredGaji($('#lihat-semua').data('gred'));
                    }
                })
            }
        })

        }

    function showPreviousPage() {
        $('#page2').hide();
        $('#page1').show();

        var modalTitle = $('#title-role');
        modalTitle.text('Kemaskini Gred Gaji');
    }
</script>
