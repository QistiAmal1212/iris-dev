<div class="accordion" id="accordion_exam_psl">
    {{-- Peperiksaan PSL --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_exam_psl">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#exam_psl" aria-expanded="true" aria-controls="exam_psl">
                Peperiksaan PSL
            </button>
        </h2>
        <div id="exam_psl" class="accordion-collapse collapse show" aria-labelledby="heading_exam_psl" data-bs-parent="#accordion_exam_psl">
            <div class="accordion-body">
                <div class="d-flex justify-content-end align-items-center mb-1" id="update_psl" style="display:none">
                    <a class="me-3 text-danger" type="button" onclick="editPsl()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>

                <form id="pslForm" action="{{ route('psl.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadPsl" data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="psl_no_pengenalan" id="psl_no_pengenalan" value="">
                        <input type="hidden" name="id_psl" id="id_psl" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Jenis Peperiksaan</label>
                            <select class="select2 form-control" value="" id="jenis_peperiksaan" name="jenis_peperiksaan" disabled>
                                <option value="" hidden>Jenis Peperiksaan</option>
                                    @foreach($jenisPeperiksaan as $peperiksaan)
                                        <option value="{{ $peperiksaan->code }}">{{ $peperiksaan->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tarikh Peperiksaan</label>
                            <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="tarikh_peperiksaan" id="tarikh_peperiksaan" disabled />
                        </div>

                        <div id="button_action_psl" style="display:none">
                            <button type="button" id="btnEditPsl" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadPsl()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSavePsl" onclick="$('#btnEditPsl').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-psl">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Jenis Peperiksaan</th>
                                <th>Tarikh Peperiksaan</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Peperiksaan PSL HISTORY --}}
    <div class="accordion-item">
        <!-- <h2 class="accordion-header" id="heading_history_exam_psl">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_exam_psl" aria-expanded="false" aria-controls="history_exam_psl">
                Jejak Audit [Peperiksaan PSL]
            </button>
        </h2> -->
        <div id="history_exam_psl" class="accordion-collapse collapse" aria-labelledby="heading_history_exam_psl" data-bs-parent="#accordion_exam_psl">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Mula</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Akhir</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <a class="me-3" type="button" id="reset" href="#">
                            <span class="text-danger"> Set Semula </span>
                        </a>
                        <button type="submit" class="btn btn-success float-right">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Maklumat</th>
                                <th>Status</th>
                                <th>Tarikh</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function editPsl() {
        $('#pslForm select[name="jenis_peperiksaan"]').attr('disabled', false);
        $('#pslForm input[name="tarikh_peperiksaan"]').attr('disabled', false);

        $("#button_action_psl").attr("style", "display:block");
    }
    function reloadPsl() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#pslForm input[name="psl_no_pengenalan"]').val(no_pengenalan);

        var reloadPslUrl = "{{ route('psl.list', ':replaceThis') }}"
        reloadPslUrl = reloadPslUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPslUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pslForm select[name="jenis_peperiksaan"]').val('').trigger('change');
                $('#pslForm input[name="tarikh_peperiksaan"]').val('');
                $('#pslForm select[name="jenis_peperiksaan"]').attr('disabled', true);
                $('#pslForm input[name="tarikh_peperiksaan"]').attr('disabled', true);
                $('#pslForm').attr('action', "{{ route('psl.store')  }}");
                $('#btnSavePsl').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_psl").attr("style", "display:none");

                $('#table-psl tbody').empty();
                var trPsl = '';
                var bilPsl = 0;
                $.each(data.detail, function(i, item) {
                        bilPsl += 1;
                        trPsl += '<tr>';
                        trPsl += '<td align="center">' + bilPsl + '</td>'
                        trPsl += '<td>' + item.qualification.name + '</td>';
                        trPsl += '<td>' + (item.tarikh_exam ? item.tarikh_exam : '') + '</td>';
                        trPsl += '<td align="center"><i class="fas fa-pencil text-primary editPsl-btn" data-id="' + item.id + ' "></i>';
                        trPsl += '&nbsp;&nbsp;';
                        trPsl += '<i class="fas fa-trash text-danger deletePsl-btn" data-id="' + item.id + '"></i></td>';
                        trPsl += '</tr>';

                });
                $('#table-psl tbody').append(trPsl);

                if($('#table-psl tbody').is(':empty')){
                    var trPsl = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    $('#table-psl tbody').append(trPsl);
                }

                $(document).on('click', '.editPsl-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#pslForm').attr('action', "{{ route('psl.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#pslForm input[name="id_psl"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#pslForm select[name="jenis_peperiksaan"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#pslForm input[name="tarikh_peperiksaan"]').val($(row).find('td:nth-child(3)').text());

                });


                $(document).on('click', '.deletePsl-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('psl.delete', ':replaceThis') }}", reloadPsl )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
