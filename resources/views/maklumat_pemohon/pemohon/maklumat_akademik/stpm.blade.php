<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-stpm-info" role="tab" id="academic-stpm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    STPM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Tinggi Persekolahan Malaysia
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-stam-info" role="tab" id="academic-stam-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    STAM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Tinggi Agama Malaysia
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-matrik-info" role="tab" id="academic-matrik-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    KM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Matrikulasi
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- STPM --}}
        <div id="academic-stpm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-stpm-info-trigger">
            <div class="accordion" id="accordion_stpm">
                {{-- RESULT STPM --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_result_stpm">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#result_stpm" aria-expanded="true" aria-controls="result_stpm">
                            Sijil Tinggi Persekolahan Malaysia
                        </button>
                    </h2>
                    <div id="result_stpm" class="accordion-collapse collapse show" aria-labelledby="heading_result_stpm" data-bs-parent="#accordion_stpm">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end align-items-center mb-1" id="update_stpm" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editStpm()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>
                            <form id="stpmForm" action="{{ route('stpm.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadStpm" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="stpm_no_pengenalan" id="stpm_no_pengenalan" value="">
                                    <input type="hidden" name="id_stpm" id="id_stpm" value="">

                                    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select class="select2 form-control" value="" id="subjek_stpm" name="subjek_stpm" disabled>
                                            <option value="" hidden>Mata Pelajaran</option>
                                                @foreach($subjekStpm as $subjek)
                                                    <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                                        <label class="form-label">Gred</label>
                                        <select class="select2 form-control" value="" id="gred_stpm" name="gred_stpm" disabled>
                                            <option value="" hidden>Gred</option>
                                                @foreach($gredStpm as $gred)
                                                    <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                                        <label class="form-label">Tahun</label>
                                        <input type="text" class="form-control" value="" id="tahun_stpm" name="tahun_stpm" disabled>
                                    </div>

                                    <div id="button_action_stpm" style="display:none">
                                        <button type="button" id="btnEditStpm" hidden onclick="generalFormSubmit(this);"></button>
                                        <div class="d-flex justify-content-end align-items-center my-1">
                                            <button type="button" class="btn btn-danger me-1" onclick="reloadStpm()">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <button type="button" class="btn btn-success float-right" id="btnSaveStpm" onclick="$('#btnEditStpm').trigger('click');">
                                                <i class="fa fa-save"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mb-1 mt-1">
                                <table class="table header_uppercase table-bordered table-hovered" id="table-stpm">
                                    <thead>
                                        <tr>
                                            <th>Bil.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>Tahun</th>
                                            <th>Kemaskini</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STPM HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_stpm">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_stpm" aria-expanded="false" aria-controls="history_stpm">
                            Jejak Audit [Sijil Tinggi Persekolahan Malaysia]
                        </button>
                    </h2>
                    <div id="history_stpm" class="accordion-collapse collapse" aria-labelledby="heading_history_stpm" data-bs-parent="#accordion_stpm">
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
                                            <th>Kod</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>Tahun</th>
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
        </div>

        {{-- STAM --}}
        <div id="academic-stam-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-stam-info-trigger">
            <div class="accordion" id="accordion_stam">
                {{-- RESULT STAM --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_result_stam">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#result_stam" aria-expanded="true" aria-controls="result_stam">
                            Sijil Tinggi Agama Malaysia
                        </button>
                    </h2>
                    <div id="result_stam" class="accordion-collapse collapse show" aria-labelledby="heading_result_stam" data-bs-parent="#accordion_stam">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end align-items-center mb-1" id="update_stam" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editStam()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            <form id="stamForm" action="{{ route('stam.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadStam" data-reloadPage="false">
                                @csrf
                                <div class="row">

                                    <input type="hidden" name="stam_no_pengenalan" id="stam_no_pengenalan" value="">
                                    <input type="hidden" name="id_stam" id="id_stam" value="">

                                    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select class="select2 form-control" value="" id="subjek_stam" name="subjek_stam" disabled>
                                            <option value="" hidden>Mata Pelajaran</option>
                                                @foreach($subjekStam as $subjek)
                                                    <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                                        <label class="form-label">Gred</label>
                                        <select class="select2 form-control" value="" id="gred_stam" name="gred_stam" disabled>
                                            <option value="" hidden>Gred</option>
                                                @foreach($gredStam as $gred)
                                                    <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                                        <label class="form-label">Tahun</label>
                                        <input type="text" class="form-control" value="" id="tahun_stam" name="tahun_stam" disabled>
                                    </div>

                                    <div id="button_action_stam" style="display:none">
                                        <button type="button" id="btnEditStam" hidden onclick="generalFormSubmit(this);"></button>
                                        <div class="d-flex justify-content-end align-items-center my-1">
                                            <button type="button" class="btn btn-danger me-1" onclick="reloadStam()">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <button type="button" class="btn btn-success float-right" id="btnSaveStam" onclick="$('#btnEditStam').trigger('click');">
                                                <i class="fa fa-save"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mb-1 mt-1">
                                <table class="table header_uppercase table-bordered table-hovered" id="table-stam">
                                    <thead>
                                        <tr>
                                            <th>Bil.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>Tahun</th>
                                            <th>Kemaskini</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STAM HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_stam">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_stam" aria-expanded="false" aria-controls="history_stam">
                            Jejak Audit [Sijil Tinggi Agama Malaysia]
                        </button>
                    </h2>
                    <div id="history_stam" class="accordion-collapse collapse" aria-labelledby="heading_history_stam" data-bs-parent="#accordion_stam">
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
                                            <th>Kod</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>Tahun</th>
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
        </div>

        {{-- MATRIK --}}
        <div id="academic-matrik-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-matrik-info-trigger">
            <div class="accordion" id="accordion_matrik">
                {{-- RESULT MATRIK --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_result_matrik">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#result_matrik" aria-expanded="true" aria-controls="result_matrik">
                            Sijil Matrikulasi
                        </button>
                    </h2>
                    <div id="result_matrik" class="accordion-collapse collapse show" aria-labelledby="heading_result_matrik" data-bs-parent="#accordion_matrik">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end align-items-center mb-1" id="update_matrikulasi" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editMatrikulasi()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            <form id="matrikulasiForm" action="{{ route('matrikulasi.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadMatrikulasi" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="matrikulasi_no_pengenalan" id="matrikulasi_no_pengenalan" value="">
                                    <input type="hidden" name="id_matrikulasi" id="id_matrikulasi" value="">

                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Kolej Matrikulasi</label>
                                        <select class="select2 form-control" value="" id="kolej_matrikulasi" name="kolej_matrikulasi" disabled>
                                            <option value="" hidden>Kolej Matrikulasi</option>
                                                @foreach($kolejMatrikulasi as $kolej)
                                                    <option value="{{ $kolej->code }}">{{ $kolej->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Jurusan</label>
                                        <select class="select2 form-control" value="" id="jurusan_matrikulasi" name="jurusan_matrikulasi" disabled>
                                            <option value="" hidden>Jurusan</option>
                                                @foreach($jurusanMatrikulasi as $jurusanMatrikulasi)
                                                    <option value="{{ $jurusanMatrikulasi->code }}">{{ $jurusanMatrikulasi->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">No. Matrik</label>
                                        <input type="text" class="form-control" value="" id="matrik_matrikulasi" name="matrik_matrikulasi" disabled>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Sesi</label>
                                        <input type="text" class="form-control" value="" id="sesi_matrikulasi" name="sesi_matrikulasi" disabled>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Semester</label>
                                        <input type="text" class="form-control" value="" id="semester_matrikulasi" name="semester_matrikulasi" disabled>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select class="select2 form-control" value="" id="subjek_matrikulasi" name="subjek_matrikulasi" disabled>
                                            <option value="" hidden>Mata Pelajaran</option>
                                                @foreach($subjekMatrikulasi as $subjekMatrikulasi)
                                                    <option value="{{ $subjekMatrikulasi->code }}">{{ $subjekMatrikulasi->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
                                        <label class="form-label">Gred</label>
                                        <input type="text" class="form-control" value="" id="gred_matrikulasi" name="gred_matrikulasi" disabled>
                                    </div>

                                    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
                                        <label class="form-label">PNGK</label>
                                        <input type="text" class="form-control" value="" id="pngk_matrikulasi" name="pngk_matrikulasi" disabled>
                                    </div>

                                    <div id="button_action_matrikulasi" style="display:none">
                                        <button type="button" id="btnEditMatrikulasi" hidden onclick="generalFormSubmit(this);"></button>
                                        <div class="d-flex justify-content-end align-items-center my-1">
                                            <button type="button" class="btn btn-danger me-1" onclick="reloadMatrikulasi()">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <button type="button" class="btn btn-success float-right" id="btnSaveMatrikulasi" onclick="$('#btnEditMatrikulasi').trigger('click');">
                                                <i class="fa fa-save"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mb-1 mt-1">
                                <table class="table header_uppercase table-bordered table-hovered" id="table-matrikulasi">
                                    <thead>
                                        <tr>
                                            <th>Bil.</th>
                                            <th>Kolej</th>
                                            <th>Jurusan</th>
                                            <th>No Matrik</th>
                                            <th>Sesi</th>
                                            <th>Semester</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>PNGK</th>
                                            <th>Kemaskini</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MATRIK HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_matrik">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_matrik" aria-expanded="false" aria-controls="history_matrik">
                            Jejak Audit [Sijil Vokasional Malaysia]
                        </button>
                    </h2>
                    <div id="history_matrik" class="accordion-collapse collapse" aria-labelledby="heading_history_matrik" data-bs-parent="#accordion_matrik">
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
                                            <th>Kod</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Gred</th>
                                            <th>Tahun</th>
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
        </div>
    </div>
</div>

<script>
    function editStpm() {
        $('#stpmForm select[name="subjek_stpm"]').attr('disabled', false);
        $('#stpmForm select[name="gred_stpm"]').attr('disabled', false);
        $('#stpmForm input[name="tahun_stpm"]').attr('disabled', false);

        $("#button_action_stpm").attr("style", "display:block");
    }

    function reloadStpm() {
        var no_pengenalan = $('#stpm_no_pengenalan').val();
        $('#stpmForm input[name="stpm_no_pengenalan"]').val(no_pengenalan);

        var reloadStpmUrl = "{{ route('stpm.list', ':replaceThis') }}"
        reloadStpmUrl = reloadStpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stpmForm select[name="subjek_stpm"]').val('').trigger('change');
                $('#stpmForm select[name="gred_stpm"]').val('').trigger('change');
                $('#stpmForm input[name="tahun_stpm"]').val('');
                $('#stpmForm select[name="subjek_stpm"]').attr('disabled', true);
                $('#stpmForm select[name="gred_stpm"]').attr('disabled', true);
                $('#stpmForm input[name="tahun_stpm"]').attr('disabled', true);
                $('#stpmForm').attr('action', "{{ route('stpm.store')  }}");
                $('#btnSaveStpm').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stpm").attr("style", "display:none");


                $('#table-stpm tbody').empty();
                var trStpm = '';
                var bilStpm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStpm += 1;
                        trStpm += '<tr>';
                        trStpm += '<td align="center">' + bilStpm + '</td>';
                        trStpm += '<td>' + item.subject_form6.name + '</td>';
                        trStpm += '<td align="center">' + item.gred + '</td>';
                        trStpm += '<td align="center">' + item.tahun + '</td>';
                        trStpm += '<td align="center"><i class="fas fa-pencil text-primary editStpm-btn" data-id="' + item.id + ' " data-form="stpm"></i>';
                        trStpm += '&nbsp;&nbsp;';
                        trStpm += '<i class="fas fa-trash text-danger deleteStpm-btn" data-id="' + item.id + '"></i></td>';
                        trStpm += '</tr>';
                    }
                });
                $('#table-stpm tbody').append(trStpm);

                if($('#table-stpm tbody').is(':empty')){
                    var trStpm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stpm tbody').append(trStpm);
                }

                $(document).on('click', '.editStpm-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stpmForm').attr('action', "{{ route('stpm.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stpmForm input[name="id_stpm"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#stpmForm select[name="subjek_stpm"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stpmForm select[name="gred_stpm"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#stpmForm input[name="tahun_stpm"]').val($(row).find('td:nth-child(4)').text());

                });


                $(document).on('click', '.deleteStpm-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stpm.delete', ':replaceThis') }}", reloadStpm )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editStam() {
        $('#stamForm select[name="subjek_stam"]').attr('disabled', false);
        $('#stamForm select[name="gred_stam"]').attr('disabled', false);
        $('#stamForm input[name="tahun_stam"]').attr('disabled', false);

        $("#button_action_stam").attr("style", "display:block");
    }

    function reloadStam() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#stamForm input[name="stam_no_pengenalan"]').val(no_pengenalan);

        var reloadStamUrl = "{{ route('stam.list', ':replaceThis') }}"
        reloadStamUrl = reloadStamUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStamUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stamForm select[name="subjek_stam"]').val('').trigger('change');
                $('#stamForm select[name="gred_stam"]').val('').trigger('change');
                $('#stamForm input[name="tahun_stam"]').val('');
                $('#stamForm select[name="subjek_stam"]').attr('disabled', true);
                $('#stamForm select[name="gred_stam"]').attr('disabled', true);
                $('#stamForm input[name="tahun_stam"]').attr('disabled', true);
                $('#stamForm').attr('action', "{{ route('stam.store')  }}");
                $('#btnSaveStam').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stam").attr("style", "display:none");


                $('#table-stam tbody').empty();
                var trStam = '';
                var bilStam = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStam += 1;
                        trStam += '<tr>';
                        trStam += '<td align="center">' + bilStam + '</td>';
                        trStam += '<td>' + item.subject_form6.name + '</td>';
                        trStam += '<td align="center">' + item.gred + '</td>';
                        trStam += '<td align="center">' + item.tahun + '</td>';
                        trStam += '<td align="center"><i class="fas fa-pencil text-primary editStam-btn" data-id="' + item.id + ' " data-form="stam"></i>';
                        trStam += '&nbsp;&nbsp;';
                        trStam += '<i class="fas fa-trash text-danger deleteStam-btn" data-id="' + item.id + '"></i></td>';
                        trStam += '</tr>';
                    }
                });
                $('#table-stam tbody').append(trStam);

                if($('#table-stam tbody').is(':empty')){
                    var trStam = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stam tbody').append(trStam);
                }

                $(document).on('click', '.editStam-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stamForm').attr('action', "{{ route('stam.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stamForm input[name="id_stam"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#stamForm select[name="subjek_stam"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stamForm select[name="gred_stam"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#stamForm input[name="tahun_stam"]').val($(row).find('td:nth-child(4)').text());
                });


                $(document).on('click', '.deleteStam-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stam.delete', ':replaceThis') }}", reloadStam )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editMatrikulasi() {
        $('#matrikulasiForm select[name="kolej_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm select[name="jurusan_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm input[name="matrik_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm input[name="sesi_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm input[name="semester_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm select[name="subjek_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm input[name="gred_matrikulasi"]').attr('disabled', false);
        $('#matrikulasiForm input[name="pngk_matrikulasi"]').attr('disabled', false);

        $("#button_action_matrikulasi").attr("style", "display:block");
    }

    function reloadMatrikulasi() {
        var no_pengenalan = $('#matrikulasi_no_pengenalan').val();
        $('#matrikulasiForm input[name="matrikulasi_no_pengenalan"]').val(no_pengenalan);

        var reloadMatrikulasiUrl = "{{ route('matrikulasi.list', ':replaceThis') }}"
        reloadMatrikulasiUrl = reloadMatrikulasiUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadMatrikulasiUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#matrikulasiForm select[name="kolej_matrikulasi"]').val('').trigger('change');
                $('#matrikulasiForm select[name="jurusan_matrikulasi"]').val('').trigger('change');
                $('#matrikulasiForm input[name="matrik_matrikulasi"]').val('');
                $('#matrikulasiForm input[name="sesi_matrikulasi"]').val('');
                $('#matrikulasiForm input[name="semester_matrikulasi"]').val('');
                $('#matrikulasiForm select[name="subjek_matrikulasi"]').val('').trigger('change');
                $('#matrikulasiForm input[name="gred_matrikulasi"]').val('');
                $('#matrikulasiForm input[name="pngk_matrikulasi"]').val('');

                $('#matrikulasiForm select[name="kolej_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm select[name="jurusan_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm input[name="matrik_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm input[name="sesi_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm input[name="semester_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm select[name="subjek_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm input[name="gred_matrikulasi"]').attr('disabled', true);
                $('#matrikulasiForm input[name="pngk_matrikulasi"]').attr('disabled', true);

                $('#matrikulasiForm').attr('action', "{{ route('matrikulasi.store')  }}");
                $('#btnSaveMatrikulasi').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_matrikulasi").attr("style", "display:none");

                $('#table-matrikulasi tbody').empty();
                var trMatrikulasi = '';
                var bilMatrikulasi = 0;
                $.each(data.detail, function(i, item) {
                        bilMatrikulasi += 1;
                        trMatrikulasi += '<tr>';
                        trMatrikulasi += '<td align="center">' + bilMatrikulasi + '</td>';
                        trMatrikulasi += '<td>' + item.college.name + '</td>';
                        trMatrikulasi += '<td align="center">' + item.course.name + '</td>';
                        trMatrikulasi += '<td align="center">' + item.no_matrik + '</td>';
                        trMatrikulasi += '<td>' + item.sesi + '</td>';
                        trMatrikulasi += '<td align="center">' + item.semester + '</td>';
                        trMatrikulasi += '<td align="center">' + item.subject.name + '</td>';
                        trMatrikulasi += '<td align="center">' + item.gred + '</td>';
                        trMatrikulasi += '<td align="center">' + item.pngk + '</td>';
                        trMatrikulasi += '<td align="center"><i class="fas fa-pencil text-primary editMatrikulasi-btn" data-id="' + item.id + ' " data-form="matrikulasi"></i>';
                        trMatrikulasi += '&nbsp;&nbsp;';
                        trMatrikulasi += '<i class="fas fa-trash text-danger deleteMatrikulasi-btn" data-id="' + item.id + '"></i></td>';
                });
                $('#table-matrikulasi tbody').append(trMatrikulasi);

                if($('#table-matrikulasi tbody').is(':empty')){
                    var trMatrikulasi = '<tr><td align="center" colspan="10">*Tiada Rekod*</td></tr>';
                    $('#table-matrikulasi tbody').append(trMatrikulasi);
                }

                $(document).on('click', '.editMatrikulasi-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#matrikulasiForm').attr('action', "{{ route('matrikulasi.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#matrikulasiForm input[name="id_matrikulasi"]').val(id);
                    var kolejName = $(row).find('td:nth-child(2)').text();
                    $('#matrikulasiForm select[name="kolej_matrikulasi"] option').filter(function() {
                        return $(this).text() === kolejName;
                    }).prop('selected', true).trigger('change');
                    var jurusanName = $(row).find('td:nth-child(3)').text();
                    $('#matrikulasiForm select[name="jurusan_matrikulasi"] option').filter(function() {
                        return $(this).text() === jurusanName;
                    }).prop('selected', true).trigger('change');
                    $('#matrikulasiForm input[name="matrik_matrikulasi"]').val($(row).find('td:nth-child(4)').text());
                    $('#matrikulasiForm input[name="sesi_matrikulasi"]').val($(row).find('td:nth-child(5)').text());
                    $('#matrikulasiForm input[name="semester_matrikulasi"]').val($(row).find('td:nth-child(6)').text());
                    var subjekName = $(row).find('td:nth-child(7)').text();
                    $('#matrikulasiForm select[name="subjek_matrikulasi"] option').filter(function() {
                        return $(this).text() === subjekName;
                    }).prop('selected', true).trigger('change');
                    $('#matrikulasiForm input[name="gred_matrikulasi"]').val($(row).find('td:nth-child(8)').text());
                    $('#matrikulasiForm input[name="pngk_matrikulasi"]').val($(row).find('td:nth-child(9)').text());
                });


                $(document).on('click', '.deleteMatrikulasi-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('matrikulasi.delete', ':replaceThis') }}", reloadMatrikulasi )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
