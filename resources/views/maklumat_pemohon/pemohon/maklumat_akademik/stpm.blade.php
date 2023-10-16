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
            {{-- STPM 1 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-stpm-1" aria-expanded="false" aria-controls="result-stpm-1">
                <span class="badge badge-light-primary">
                    Sijil Tinggi Pelajaran Malaysia (STPM) [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-stpm-1">
                <div id="update_stpm1" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editStpm1()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form 
                id="stpm1Form" 
                action="{{ route('stpm1.store') }}" 
                method="POST" 
                data-refreshFunctionName="reloadTimeline" 
                data-refreshFunctionNameIfSuccess="reloadStpm1" 
                data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="stpm1_no_pengenalan" id="stpm1_no_pengenalan" value="">
                        <input type="hidden" name="id_stpm1" id="id_stpm1" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_stpm1" name="subjek_stpm1" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekStpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_stpm1" name="gred_stpm1" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredStpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_stpm1" name="tahun_stpm1" disabled>
                        </div>

                        <div id="button_action_stpm1" style="display:none">
                            <button type="button" id="btnEditStpm1" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadStpm1()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveStpm1" onclick="$('#btnEditStpm1').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-stpm1">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr class="bg-light-primary">
                                <td class="text-end" colspan="3">PNGK</td>
                                <td class="text-start fw-bolder" colspan="2">auto-calculated</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- STPM 2 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-stpm-2" aria-expanded="false" aria-controls="result-stpm-2">
                <span class="badge badge-light-primary">
                    Sijil Tinggi Pelajaran Malaysia (STPM) [2]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-stpm-2">
                <div id="update_stpm2" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editStpm2()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form 
                id="stpm2Form" 
                action="{{ route('stpm2.store') }}" 
                method="POST" 
                data-refreshFunctionName="reloadTimeline" 
                data-refreshFunctionNameIfSuccess="reloadStpm2" 
                data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="stpm2_no_pengenalan" id="stpm2_no_pengenalan" value="">
                        <input type="hidden" name="id_stpm2" id="id_stpm2" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_stpm2" name="subjek_stpm2" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekStpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_stpm2" name="gred_stpm2" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredStpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_stpm2" name="tahun_stpm2" disabled>
                        </div>

                        <div id="button_action_stpm2" style="display:none">
                            <button type="button" id="btnEditStpm2" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadStpm2()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveStpm2" onclick="$('#btnEditStpm2').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-stpm2">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr class="bg-light-primary">
                                <td class="text-end" colspan="3">PNGK</td>
                                <td class="text-start fw-bolder" colspan="2">auto-calculated</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- STAM --}}
        <div id="academic-stam-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-stam-info-trigger">
            {{-- STAM 1 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-stam-1" aria-expanded="false" aria-controls="result-stam-1">
                <span class="badge badge-light-primary">
                    Sijil Tinggi Agama Malaysia (STAM) [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-stam-1">
                <div id="update_stam1" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editStam1()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form 
                id="stam1Form" 
                action="{{ route('stam1.store') }}" 
                method="POST" 
                data-refreshFunctionName="reloadTimeline" 
                data-refreshFunctionNameIfSuccess="reloadStam1" 
                data-reloadPage="false">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="stam1_no_pengenalan" id="stam1_no_pengenalan" value="">
                        <input type="hidden" name="id_stam1" id="id_stam1" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_stam1" name="subjek_stam1" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekStam as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_stam1" name="gred_stam1" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredStam as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_stam1" name="tahun_stam1" disabled>
                        </div>

                        <div id="button_action_stam1" style="display:none">
                            <button type="button" id="btnEditStam1" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadStam1()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveStam1" onclick="$('#btnEditStam1').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-stam1">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            {{-- STAM 2 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-stam-1" aria-expanded="false" aria-controls="result-stam-1">
                <span class="badge badge-light-primary">
                    Sijil Tinggi Agama Malaysia (STAM) [2]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-stam-2">
                <div id="update_stam2" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editStam2()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form 
                id="stam2Form" 
                action="{{ route('stam2.store') }}" 
                method="POST" 
                data-refreshFunctionName="reloadTimeline" 
                data-refreshFunctionNameIfSuccess="reloadStam2" 
                data-reloadPage="false">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="stam2_no_pengenalan" id="stam2_no_pengenalan" value="">
                        <input type="hidden" name="id_stam2" id="id_stam2" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_stam2" name="subjek_stam2" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekStam as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_stam2" name="gred_stam2" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredStam as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_stam2" name="tahun_stam2" disabled>
                        </div>

                        <div id="button_action_stam2" style="display:none">
                            <button type="button" id="btnEditStam2" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadStam2()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveStam2" onclick="$('#btnEditStam2').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-stam2">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- MATRIK --}}
        <div id="academic-matrik-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-matrik-info-trigger">
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
                                    <option value="{{ $kolej->kod }}">{{ $kolej->diskripsi }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label">Jurusan</label>
                        <select class="select2 form-control" value="" id="jurusan_matrikulasi" name="jurusan_matrikulasi" disabled>
                            <option value="" hidden>Jurusan</option>
                                @foreach($jurusanMatrikulasi as $jurusanMatrikulasi)
                                    <option value="{{ $jurusanMatrikulasi->kod }}">{{ $jurusanMatrikulasi->diskripsi }}</option>
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
                                    <option value="{{ $subjekMatrikulasi->kod }}">{{ $subjekMatrikulasi->diskripsi }}</option>
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
                            <th>Sesi</th>
                            <th>Semester</th>
                            <th>Kod MP</th>
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                            <th>Kemaskini</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function editStpm1() {
        $('#stpm1Form select[name="subjek_stpm1"]').attr('disabled', false);
        $('#stpm1Form select[name="gred_stpm1"]').attr('disabled', false);
        $('#stpm1Form input[name="tahun_stpm1"]').attr('disabled', false);

        $("#button_action_stpm1").attr("style", "display:block");
    }

    function reloadStpm1() {
        var no_pengenalan = $('#stpm1_no_pengenalan').val();
        $('#stpm1Form input[name="stpm1_no_pengenalan"]').val(no_pengenalan);

        var reloadStpmUrl = "{{ route('stpm1.list', ':replaceThis') }}"
        reloadStpmUrl = reloadStpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stpm1Form select[name="subjek_stpm1"]').val('').trigger('change');
                $('#stpm1Form select[name="gred_stpm1"]').val('').trigger('change');
                $('#stpm1Form input[name="tahun_stpm1"]').val('');
                $('#stpm1Form select[name="subjek_stpm1"]').attr('disabled', true);
                $('#stpm1Form select[name="gred_stpm1"]').attr('disabled', true);
                $('#stpm1Form input[name="tahun_stpm1"]').attr('disabled', true);
                $('#stpm1Form').attr('action', "{{ route('stpm1.store')  }}");
                $('#btnSaveStpm1').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stpm1").attr("style", "display:none");

                $('#table-stpm1 tbody').empty();
                var trStpm = '';
                var bilStpm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStpm += 1;
                        trStpm += '<tr>';
                        trStpm += '<td align="center">' + bilStpm + '</td>';
                        trStpm += '<td>' + item.subject_form6.kod + '</td>'; //KOD MP
                        trStpm += '<td>' + item.subject_form6.diskripsi + '</td>';
                        trStpm += '<td align="center">' + item.gred + '</td>';
                        trStpm += '<td align="center"><i class="fas fa-pencil text-primary editStpm1-btn" data-id="' + item.id + ' " data-form="stpm"></i>';
                        trStpm += '&nbsp;&nbsp;';
                        trStpm += '<i class="fas fa-trash text-danger deleteStpm1-btn" data-id="' + item.id + '"></i></td>';
                        trStpm += '</tr>';
                    }
                });
                $('#table-stpm1 tbody').append(trStpm);

                if($('#table-stpm1 tbody').is(':empty')){
                    var trStpm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stpm1 tbody').append(trStpm);
                }

                $(document).on('click', '.editStpm1-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stpm1Form').attr('action', "{{ route('stpm1.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stpm1Form input[name="id_stpm1"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#stpm1Form select[name="subjek_stpm1"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stpm1Form select[name="gred_stpm1"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#stpm1Form input[name="tahun_stpm1"]').val($(row).find('td:nth-child(4)').text());

                });

                $(document).on('click', '.deleteStpm1-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stpm1.delete', ':replaceThis') }}", reloadStpm1 )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editStpm2() {
        $('#stpm2Form select[name="subjek_stpm2"]').attr('disabled', false);
        $('#stpm2Form select[name="gred_stpm2"]').attr('disabled', false);
        $('#stpm2Form input[name="tahun_stpm2"]').attr('disabled', false);

        $("#button_action_stpm2").attr("style", "display:block");
    }

    function reloadStpm2() {
        var no_pengenalan = $('#stpm2_no_pengenalan').val();
        $('#stpm2Form input[name="stpm2_no_pengenalan"]').val(no_pengenalan);

        var reloadStpmUrl = "{{ route('stpm2.list', ':replaceThis') }}"
        reloadStpmUrl = reloadStpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stpm2Form select[name="subjek_stpm2"]').val('').trigger('change');
                $('#stpm2Form select[name="gred_stpm2"]').val('').trigger('change');
                $('#stpm2Form input[name="tahun_stpm2"]').val('');
                $('#stpm2Form select[name="subjek_stpm2"]').attr('disabled', true);
                $('#stpm2Form select[name="gred_stpm2"]').attr('disabled', true);
                $('#stpm2Form input[name="tahun_stpm2"]').attr('disabled', true);
                $('#stpm2Form').attr('action', "{{ route('stpm2.store')  }}");
                $('#btnSaveStpm2').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stpm2").attr("style", "display:none");

                $('#table-stpm2 tbody').empty();
                var trStpm = '';
                var bilStpm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStpm += 1;
                        trStpm += '<tr>';
                        trStpm += '<td align="center">' + bilStpm + '</td>';
                        trStpm += '<td>' + item.subject_form6.kod + '</td>'; //KOD MP
                        trStpm += '<td>' + item.subject_form6.diskripsi + '</td>';
                        trStpm += '<td align="center">' + item.gred + '</td>';
                        trStpm += '<td align="center"><i class="fas fa-pencil text-primary editStpm2-btn" data-id="' + item.id + ' " data-form="stpm"></i>';
                        trStpm += '&nbsp;&nbsp;';
                        trStpm += '<i class="fas fa-trash text-danger deleteStpm2-btn" data-id="' + item.id + '"></i></td>';
                        trStpm += '</tr>';
                    }
                });
                $('#table-stpm2 tbody').append(trStpm);

                if($('#table-stpm2 tbody').is(':empty')){
                    var trStpm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stpm2 tbody').append(trStpm);
                }

                $(document).on('click', '.editStpm2-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stpm2Form').attr('action', "{{ route('stpm2.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stpm2Form input[name="id_stpm2"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#stpm2Form select[name="subjek_stpm2"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stpm2Form select[name="gred_stpm2"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#stpm2Form input[name="tahun_stpm2"]').val($(row).find('td:nth-child(4)').text());

                });

                $(document).on('click', '.deleteStpm2-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stpm2.delete', ':replaceThis') }}", reloadStpm2 )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editStam1() {
        $('#stam1Form select[name="subjek_stam1"]').attr('disabled', false);
        $('#stam1Form select[name="gred_stam1"]').attr('disabled', false);
        $('#stam1Form input[name="tahun_stam1"]').attr('disabled', false);

        $("#button_action_stam1").attr("style", "display:block");
    }

    function reloadStam1() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#stam1Form input[name="stam1_no_pengenalan"]').val(no_pengenalan);

        var reloadStamUrl = "{{ route('stam1.list', ':replaceThis') }}"
        reloadStamUrl = reloadStamUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStamUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stam1Form select[name="subjek_stam1"]').val('').trigger('change');
                $('#stam1Form select[name="gred_stam1"]').val('').trigger('change');
                $('#stam1Form input[name="tahun_stam1"]').val('');
                $('#stam1Form select[name="subjek_stam1"]').attr('disabled', true);
                $('#stam1Form select[name="gred_stam1"]').attr('disabled', true);
                $('#stam1Form input[name="tahun_stam1"]').attr('disabled', true);
                $('#stam1Form').attr('action', "{{ route('stam1.store')  }}");
                $('#btnSaveStam1').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stam1").attr("style", "display:none");

                $('#table-stam1 tbody').empty();
                var trStam = '';
                var bilStam = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStam += 1;
                        trStam += '<tr>';
                        trStam += '<td align="center">' + bilStam + '</td>';
                        trStam += '<td>' + item.subject_form6.kod + '</td>'; //Kod MP
                        trStam += '<td>' + item.subject_form6.diskripsi + '</td>';
                        trStam += '<td align="center">' + item.gred + '</td>';
                        trStam += '<td align="center"><i class="fas fa-pencil text-primary editStam1-btn" data-id="' + item.id + ' " data-form="stam"></i>';
                        trStam += '&nbsp;&nbsp;';
                        trStam += '<i class="fas fa-trash text-danger deleteStam1-btn" data-id="' + item.id + '"></i></td>';
                        trStam += '</tr>';
                    }
                });
                $('#table-stam1 tbody').append(trStam);

                if($('#table-stam1 tbody').is(':empty')){
                    var trStam = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stam1 tbody').append(trStam);
                }

                $(document).on('click', '.editStam1-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stam1Form').attr('action', "{{ route('stam1.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stam1Form input[name="id_stam1"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#stam1Form select[name="subjek_stam1"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stam1Form select[name="gred_stam1"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#stam1Form input[name="tahun_stam1"]').val($(row).find('td:nth-child(5)').text());
                });


                $(document).on('click', '.deleteStam1-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stam1.delete', ':replaceThis') }}", reloadStam1 )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editStam2() {
        $('#stam2Form select[name="subjek_stam2"]').attr('disabled', false);
        $('#stam2Form select[name="gred_stam2"]').attr('disabled', false);
        $('#stam2Form input[name="tahun_stam2"]').attr('disabled', false);

        $("#button_action_stam2").attr("style", "display:block");
    }

    function reloadStam2() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#stam2Form input[name="stam2_no_pengenalan"]').val(no_pengenalan);

        var reloadStamUrl = "{{ route('stam2.list', ':replaceThis') }}"
        reloadStamUrl = reloadStamUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadStamUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#stam2Form select[name="subjek_stam2"]').val('').trigger('change');
                $('#stam2Form select[name="gred_stam2"]').val('').trigger('change');
                $('#stam2Form input[name="tahun_stam2"]').val('');
                $('#stam2Form select[name="subjek_stam2"]').attr('disabled', true);
                $('#stam2Form select[name="gred_stam2"]').attr('disabled', true);
                $('#stam2Form input[name="tahun_stam2"]').attr('disabled', true);
                $('#stam2Form').attr('action', "{{ route('stam2.store')  }}");
                $('#btnSaveStam2').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_stam2").attr("style", "display:none");

                $('#table-stam2 tbody').empty();
                var trStam = '';
                var bilStam = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form6 != null) {
                        bilStam += 1;
                        trStam += '<tr>';
                        trStam += '<td align="center">' + bilStam + '</td>';
                        trStam += '<td>' + item.subject_form6.kod + '</td>'; //Kod MP
                        trStam += '<td>' + item.subject_form6.diskripsi + '</td>';
                        trStam += '<td align="center">' + item.gred + '</td>';
                        trStam += '<td align="center"><i class="fas fa-pencil text-primary editStam2-btn" data-id="' + item.id + ' " data-form="stam"></i>';
                        trStam += '&nbsp;&nbsp;';
                        trStam += '<i class="fas fa-trash text-danger deleteStam2-btn" data-id="' + item.id + '"></i></td>';
                        trStam += '</tr>';
                    }
                });
                $('#table-stam2 tbody').append(trStam);

                if($('#table-stam2 tbody').is(':empty')){
                    var trStam = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-stam2 tbody').append(trStam);
                }

                $(document).on('click', '.editStam2-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#stam2Form').attr('action', "{{ route('stam2.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#stam2Form input[name="id_stam2"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#stam2Form select[name="subjek_stam2"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#stam2Form select[name="gred_stam2"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#stam2Form input[name="tahun_stam2"]').val($(row).find('td:nth-child(5)').text());
                });


                $(document).on('click', '.deleteStam2-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('stam2.delete', ':replaceThis') }}", reloadStam2 )
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
                        trMatrikulasi += '<td>' + bilMatrikulasi + '</td>',
                        trMatrikulasi += '<td>' + item.sesi + '</td>';
                        trMatrikulasi += '<td align="center">' + item.semester + '</td>';
                        trMatrikulasi += '<td align="center">' + item.subject.kod + '</td>'; // Kod MP
                        trMatrikulasi += '<td align="center">' + item.subject.diskripsi + '</td>';
                        trMatrikulasi += '<td align="center">' + item.gred + '</td>';
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
