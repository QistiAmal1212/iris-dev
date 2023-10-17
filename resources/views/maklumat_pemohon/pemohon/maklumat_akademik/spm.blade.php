<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-spm-info" role="tab" id="academic-spm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Pelajaran Malaysia/ <br>
                        SPM (Vokasional)
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_spm1" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        {{-- <div class="step" data-target="#academic-spmv-info" role="tab" id="academic-spmv-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPMV
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Pelajaran Malaysia Vokasional
                    </span>
                </span>
            </button>
        </div>

        <hr> --}}

        <div class="step" data-target="#academic-svm-info" role="tab" id="academic-svm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SVM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Vokasional Malaysia
                    </span>

                    {{-- BADGE IF NO DATA STARTS HERE --}}
                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_svm1" hidden>Tiada Maklumat</span>
                    </span>
                    {{-- UNTIL HERE --}}
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-spmu-info" role="tab" id="academic-spmu-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPM(U)
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        SPM Ulangan
                    </span>
                </span>

                <span class="bs-stepper-subtitle">
                    <span class="badge badge-light-danger fw-bolder mt-1" id="tm_spmu" hidden>Tiada Maklumat</span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- SPM --}}
        <div id="academic-spm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spm-info-trigger">

            {{-- SPM 1 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-spm-1" aria-expanded="false" aria-controls="result-spm-1">
                <span class="badge badge-light-primary">
                    Sijil Pelajaran Malaysia (SPM) / Sijil Pelajaran Malaysia Vokasional (SPMV) [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-spm-1">
                <div id="update_spm1" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editSpm1()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form
                id="spm1Form"
                action="{{ route('spm1.store') }}"
                method="POST"
                data-refreshFunctionName="reloadTimeline"
                data-refreshFunctionNameIfSuccess="reloadSpm1"
                data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="spm1_no_pengenalan" id="spm1_no_pengenalan" value="">
                        <input type="hidden" name="id_spm1" id="id_spm1" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" id="subjek_spm1" name="subjek_spm1" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekSpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" id="gred_spm1" name="gred_spm1" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredSpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_spm1" name="tahun_spm1" disabled>
                        </div>

                        <div id="button_action_spm1" style="display:none">
                            <button type="button" id="btnEditSpm1" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSpm1()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveSpm1" onclick="$('#btnEditSpm1').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-spm1">
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

            {{-- SPM 2 --}}
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-spm-2" aria-expanded="false" aria-controls="result-spm-2">
                <span class="badge badge-light-primary">
                    Sijil Pelajaran Malaysia (SPM) / Sijil Pelajaran Malaysia Vokasional (SPMV) [2]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-spm-2">
                <div id="update_spm2" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editSpm2()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form
                id="spm2Form"
                action="{{ route('spm2.store') }}"
                method="POST"
                data-refreshFunctionName="reloadTimeline"
                data-refreshFunctionNameIfSuccess="reloadSpm2"
                data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="spm2_no_pengenalan" id="spm2_no_pengenalan" value="">
                        <input type="hidden" name="id_spm2" id="id_spm2" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" id="subjek_spm2" name="subjek_spm2" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekSpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" id="gred_spm2" name="gred_spm2" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredSpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_spm2" name="tahun_spm2" disabled>
                        </div>

                        <div id="button_action_spm2" style="display:none">
                            <button type="button" id="btnEditSpm2" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSpm2()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveSpm2" onclick="$('#btnEditSpm2').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-spm2">
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

        {{-- SPMV --}}
        {{-- <div id="academic-spmv-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spmv-info-trigger">
            <div id="update_spmv" style="display:none">
                <div class="d-flex justify-content-end align-items-center mb-1">
                    <a class="me-3 text-danger" type="button" onclick="editSpmv()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>
            </div>

            <form id="spmvForm" action="{{ route('spmv.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadSpmv" data-reloadPage="false">
                @csrf
                <div class="row">
                    <input type="hidden" name="spmv_no_pengenalan" id="spmv_no_pengenalan" value="">
                    <input type="hidden" name="id_spmv" id="id_spmv" value="">

                    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                        <label class="form-label">Mata Pelajaran</label>
                        <select class="select2 form-control" value="" id="subjek_spmv" name="subjek_spmv" disabled>
                            <option value="" hidden>Mata Pelajaran</option>
                                @foreach($subjekSpmv as $subjek)
                                    <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label">Gred</label>
                        <select class="select2 form-control" value="" id="gred_spmv" name="gred_spmv" disabled>
                            <option value="" hidden>Gred</option>
                                @foreach($gredSpmv as $gred)
                                    <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label">Tahun</label>
                        <input type="text" class="form-control" value="" id="tahun_spmv" name="tahun_spmv" disabled>
                    </div>

                    <div id="button_action_spmv" style="display:none">
                        <button type="button" id="btnEditSpmv" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-danger me-1" onclick="reloadSpmv()">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" class="btn btn-success float-right" id="btnSaveSpmv" onclick="$('#btnEditSpmv').trigger('click');">
                                <i class="fa fa-save"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive mb-1 mt-1">
                <table class="table header_uppercase table-bordered table-hovered" id="table-spmv">
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
        </div> --}}

        {{-- SVM --}}
        <div id="academic-svm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-svm-info-trigger">
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-svm-1" aria-expanded="false" aria-controls="result-svm-1">
                <span class="badge badge-light-primary">
                    Sijil Vokasional Malaysia (SVM) [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-svm-1">
                <div id="update_svm" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editSvm()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form id="svmForm" 
                action="{{ route('svm.store') }}" 
                method="POST" 
                data-refreshFunctionName="reloadTimeline" 
                data-refreshFunctionNameIfSuccess="reloadSvm" 
                data-reloadPage="false">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="svm_no_pengenalan" id="svm_no_pengenalan" value="">
                        <input type="hidden" name="id_svm" id="id_svm" value="">

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_svm" name="tahun_svm" disabled>
                        </div>

                        <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <select class="select2 form-control" value="" id="kelulusan_svm" name="kelulusan_svm" disabled>
                                <option value="" hidden>Nama Sijil</option>
                                @foreach($jenisPeperiksaan as $kelulusan)
                                <option value="{{ $kelulusan->kod }}">{{ $kelulusan->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_svm" name="subjek_svm" disabled>
                                <option value="" hidden>Mata Pelajaran</option>
                                    @foreach($subjekSvm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_svm" name="gred_svm" disabled>
                                <option value="" hidden>Gred</option>
                                    @foreach($gredSvm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">PNGKA</label>
                            <input type="text" class="form-control" value="" id="pngka_svm" name="pngka_svm" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">PNGKV</label>
                            <input type="text" class="form-control" value="" id="pngkv_svm" name="pngkv_svm" disabled>
                        </div>

                        <div id="button_action_svm" style="display:none">
                            <button type="button" id="btnEditSvm" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSvm()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveSvm" onclick="$('#btnEditSvm').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-svm">
                        <thead>
                            <tr>
                                <th>Bil.</th>
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

        {{-- SPM ULANGAN --}}
        <div id="academic-spmu-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spmu-info-trigger">

            {{-- Button Kemaskini SPM ULANGAN --}}
            <div id="" style="display:none">
                <div class="d-flex justify-content-end align-items-center mb-1">
                    <a class="me-3 text-danger" type="button" onclick="">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>
            </div>

            {{-- Borang SPM ULANGAN --}}
            <form id="" action="" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="" data-reloadPage="false">
                @csrf
                <div class="row">

                    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                        <label class="form-label">Mata Pelajaran</label>
                        <select class="select2 form-control" value="" id="" name="" disabled>
                            <option value="" hidden>Mata Pelajaran</option>
                            {{-- Loop the dropdown here --}}
                                <option value=""></option>
                            {{-- Until here --}}
                        </select>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label">Gred</label>
                        <select class="select2 form-control" value="" id="" name="" disabled>
                            <option value="" hidden>Gred</option>
                                {{-- Loop the dropdown here --}}
                                    <option value=""></option>
                                {{-- Until here --}}
                        </select>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label">Tahun</label>
                        <input type="text" class="form-control" value="" id="" name="" disabled>
                    </div>

                    {{-- Button --}}
                    <div id="" style="display:none">
                        <button type="button" id="" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-danger me-1" onclick="">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" class="btn btn-success float-right" id="" onclick="">
                                <i class="fa fa-save"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Table SPM ULANGAN --}}
            <div class="table-responsive mb-1 mt-1">
                <table class="table header_uppercase table-bordered table-hovered" id="">
                    <thead>
                        <tr>
                            <th>Bil.</th>
                            <th>Tahun</th>
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
    function editSpm1() {
        $('#spm1Form select[name="subjek_spm1"]').attr('disabled', false);
        $('#spm1Form select[name="gred_spm1"]').attr('disabled', false);
        $('#spm1Form input[name="tahun_spm1"]').attr('disabled', false);

        $("#button_action_spm1").attr("style", "display:block");
    }

    function reloadSpm1() {
        var no_pengenalan = $('#spm1_no_pengenalan').val();
        $('#spm1Form input[name="spm1_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmUrl = "{{ route('spm1.list', ':replaceThis') }}"
        reloadSpmUrl = reloadSpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#spm1Form select[name="subjek_spm1"]').val('').trigger('change');
                $('#spm1Form select[name="gred_spm1"]').val('').trigger('change');
                $('#spm1Form input[name="tahun_spm1"]').val('');
                $('#spm1Form select[name="subjek_spm1"]').attr('disabled', true);
                $('#spm1Form select[name="gred_spm1"]').attr('disabled', true);
                $('#spm1Form input[name="tahun_spm1"]').attr('disabled', true);
                $('#spm1Form').attr('action', "{{ route('spm1.store')  }}");
                $('#btnSaveSpm1').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_spm1").attr("style", "display:none");

                $('#table-spm1 tbody').empty();
                var trSpm = '';
                var bilSpm = 0;
                if(data.detail.data != null){
                    $.each(data.detail.data, function(i, item) {
                        if (item.subject_form5 != null) {
                            bilSpm += 1;
                            trSpm += '<tr>';
                            trSpm += '<td align="center">' + bilSpm + '</td>';
                            trSpm += '<td>' + item.subject_form5.kod + '</td>'; //KOD MATA PELAJARAN
                            trSpm += '<td>' + item.subject_form5.diskripsi + '</td>';
                            trSpm += '<td align="center">' + item.gred + '</td>';
                            trSpm += '<td align="center"><i class="fas fa-pencil text-primary editSpm1-btn" data-id="' + item.id + ' "></i>';
                            trSpm += '&nbsp;&nbsp;';
                            trSpm += '<i class="fas fa-trash text-danger deleteSpm1-btn" data-id="' + item.id + '"></i></td>';
                            trSpm += '</tr>';
                        }
                    });
                }
                $('#table-spm1 tbody').append(trSpm);

                if($('#table-spm1 tbody').is(':empty')){
                    var trSpm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-spm1 tbody').append(trSpm);

                    var tmSpm1Element = $("#tm_spm1");
                    tmSpm1Element.removeAttr("hidden");
                }else{
                    var tmSpm1Element = $("#tm_spm1");
                    tmSpm1Element.attr("hidden", true);
                }

                $(document).on('click', '.editSpm1-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#spm1Form').attr('action', "{{ route('spm1.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#spm1Form input[name="id_spm1"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#spm1Form select[name="subjek_spm1"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#spm1Form select[name="gred_spm1"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#spm1Form input[name="tahun_spm1"]').val($(row).find('td:nth-child(5)').text());
                });


                $(document).on('click', '.deleteSpm1-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('spm1.delete', ':replaceThis') }}", reloadSpm1 )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editSpm2() {
        $('#spm2Form select[name="subjek_spm2"]').attr('disabled', false);
        $('#spm2Form select[name="gred_spm2"]').attr('disabled', false);
        $('#spm2Form input[name="tahun_spm2"]').attr('disabled', false);

        $("#button_action_spm2").attr("style", "display:block");
    }

    function reloadSpm2() {
        var no_pengenalan = $('#spm2_no_pengenalan').val();
        $('#spm2Form input[name="spm2_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmUrl = "{{ route('spm2.list', ':replaceThis') }}"
        reloadSpmUrl = reloadSpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#spm2Form select[name="subjek_spm2"]').val('').trigger('change');
                $('#spm2Form select[name="gred_spm2"]').val('').trigger('change');
                $('#spm2Form input[name="tahun_spm2"]').val('');
                $('#spm2Form select[name="subjek_spm2"]').attr('disabled', true);
                $('#spm2Form select[name="gred_spm2"]').attr('disabled', true);
                $('#spm2Form input[name="tahun_spm2"]').attr('disabled', true);
                $('#spm2Form').attr('action', "{{ route('spm2.store')  }}");
                $('#btnSaveSpm2').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_spm2").attr("style", "display:none");

                $('#table-spm2 tbody').empty();
                var trSpm = '';
                var bilSpm = 0;
                if(data.detail.data != null){
                    $.each(data.detail.data, function(i, item) {
                        if (item.subject_form5 != null) {
                            bilSpm += 1;
                            trSpm += '<tr>';
                            trSpm += '<td align="center">' + bilSpm + '</td>';
                            trSpm += '<td>' + item.subject_form5.kod + '</td>'; //KOD MATA PELAJARAN
                            trSpm += '<td>' + item.subject_form5.diskripsi + '</td>';
                            trSpm += '<td align="center">' + item.gred + '</td>';
                            trSpm += '<td align="center"><i class="fas fa-pencil text-primary editSpm2-btn" data-id="' + item.id + ' "></i>';
                            trSpm += '&nbsp;&nbsp;';
                            trSpm += '<i class="fas fa-trash text-danger deleteSpm2-btn" data-id="' + item.id + '"></i></td>';
                            trSpm += '</tr>';
                        }
                    });
                }
                $('#table-spm2 tbody').append(trSpm);

                if($('#table-spm2 tbody').is(':empty')){
                    var trSpm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-spm2 tbody').append(trSpm);
                }

                $(document).on('click', '.editSpm2-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#spm2Form').attr('action', "{{ route('spm2.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#spm2Form input[name="id_spm2"]').val(id);
                    var subjectName = $(row).find('td:nth-child(3)').text();
                    $('#spm2Form select[name="subjek_spm2"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#spm2Form select[name="gred_spm2"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                    //$('#spm2Form input[name="tahun_spm2"]').val($(row).find('td:nth-child(5)').text());
                });


                $(document).on('click', '.deleteSpm2-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('spm2.delete', ':replaceThis') }}", reloadSpm2 )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editSpmv() {
        $('#spmvForm select[name="subjek_spmv"]').attr('disabled', false);
        $('#spmvForm select[name="gred_spmv"]').attr('disabled', false);
        $('#spmvForm input[name="tahun_spmv"]').attr('disabled', false);

        $("#button_action_spmv").attr("style", "display:block");
    }

    function reloadSpmv() {
        var no_pengenalan = $('#spmv_no_pengenalan').val();
        $('#spmvForm input[name="spmv_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmvUrl = "{{ route('spmv.list', ':replaceThis') }}"
        reloadSpmvUrl = reloadSpmvUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmvUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#spmvForm select[name="subjek_spmv"]').val('').trigger('change');
                $('#spmvForm select[name="gred_spmv"]').val('').trigger('change');
                $('#spmvForm input[name="tahun_spmv"]').val('');
                $('#spmvForm select[name="subjek_spmv"]').attr('disabled', true);
                $('#spmvForm select[name="gred_spmv"]').attr('disabled', true);
                $('#spmvForm input[name="tahun_spmv"]').attr('disabled', true);
                $('#spmvForm').attr('action', "{{ route('spmv.store')  }}");
                $('#btnSaveSpmv').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_spmv").attr("style", "display:none");


                $('#table-spmv tbody').empty();
                var trSpmv = '';
                var bilSpmv = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form5 != null) {
                        bilSpmv += 1;
                        trSpmv += '<tr>';
                        trSpmv += '<td align="center">' + bilSpmv + '</td>';
                        trSpmv += '<td>' + item.subject_form5.diskripsi + '</td>'; //KOD MATA PELAJARAN
                        trSpmv += '<td>' + item.subject_form5.diskripsi + '</td>';
                        trSpmv += '<td align="center">' + item.gred + '</td>';
                        trSpmv += '<td align="center"><i class="fas fa-pencil text-primary editSpmv-btn" data-id="' + item.id + ' "></i>';
                        trSpmv += '&nbsp;&nbsp;';
                        trSpmv += '<i class="fas fa-trash text-danger deleteSpmv-btn" data-id="' + item.id + '"></i></td>';
                        trSpmv += '</tr>';
                    }
                });
                $('#table-spmv tbody').append(trSpmv);

                if($('#table-spmv tbody').is(':empty')){
                    var trSpmv = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-spmv tbody').append(trSpmv);
                }

                $(document).on('click', '.editSpmv-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#spmvForm').attr('action', "{{ route('spmv.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#spmvForm input[name="id_spmv"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#spmvForm select[name="subjek_spmv"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#spmvForm select[name="gred_spmv"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#spmvForm input[name="tahun_spmv"]').val($(row).find('td:nth-child(4)').text());
                });

                $(document).on('click', '.deleteSpmv-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('spmv.delete', ':replaceThis') }}", reloadSpmv )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function editSvm() {
        $('#svmForm input[name="tahun_svm"]').attr('disabled', false);
        $('#svmForm select[name="kelulusan_svm"]').attr('disabled', false);
        $('#svmForm select[name="subjek_svm"]').attr('disabled', false);
        $('#svmForm select[name="gred_svm"]').attr('disabled', false);
        $('#svmForm input[name="pngka_svm"]').attr('disabled', false);
        $('#svmForm input[name="pngkv_svm"]').attr('disabled', false);

        $("#button_action_svm").attr("style", "display:block");
    }

    function reloadSvm() {
        var no_pengenalan = $('#svm_no_pengenalan').val();
        $('#svmForm input[name="svm_no_pengenalan"]').val(no_pengenalan);

        var reloadSvmUrl = "{{ route('svm.list', ':replaceThis') }}"
        reloadSvmUrl = reloadSvmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSvmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#svmForm select[name="subjek_svm"]').val('').trigger('change');
                $('#svmForm select[name="gred_svm"]').val('').trigger('change');
                $('#svmForm input[name="tahun_svm"]').val('');
                $('#svmForm select[name="subjek_svm"]').attr('disabled', true);
                $('#svmForm select[name="gred_svm"]').attr('disabled', true);
                $('#svmForm input[name="tahun_svm"]').attr('disabled', true);
                $('#svmForm').attr('action', "{{ route('svm.store')  }}");
                $('#btnSaveSvm').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_svm").attr("style", "display:none");


                $('#table-svm tbody').empty();
                var trSvm = '';
                var bilSvm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject_form5 != null) {
                        bilSvm += 1;
                        trSvm += '<tr>';
                        trSvm += '<td align="center">' + bilSvm + '</td>';
                        trSvm += '<td>' + item.subject_form5.diskripsi + '</td>'; //KOD MATA PELAJARAN
                        trSvm += '<td>' + item.subject_form5.diskripsi + '</td>';
                        trSvm += '<td align="center">' + item.gred + '</td>';
                        trSvm += '<td align="center"><i class="fas fa-pencil text-primary editSvm-btn" data-id="' + item.id + ' "></i>';
                        trSvm += '&nbsp;&nbsp;';
                        trSvm += '<i class="fas fa-trash text-danger deleteSvm-btn" data-id="' + item.id + '"></i></td>';
                        trSvm += '</tr>';
                    }
                });
                $('#table-svm tbody').append(trSvm);

                if($('#table-svm tbody').is(':empty')){
                    var trSvm = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-svm tbody').append(trSvm);
                }

                $(document).on('click', '.editSvm-btn', function() {
                        $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                        $('#svmForm').attr('action', "{{ route('svm.update') }}");
                        var row = $(this).closest('tr');
                        var id = $(this).data('id');

                        $('#svmForm input[name="id_svm"]').val(id);
                        var subjectName = $(row).find('td:nth-child(2)').text();
                        $('#svmForm select[name="subjek_svm"] option').filter(function() {
                            return $(this).text() === subjectName;
                        }).prop('selected', true).trigger('change');
                        $('#svmForm select[name="gred_svm"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                        $('#svmForm input[name="tahun_svm"]').val($(row).find('td:nth-child(4)').text());
                });


                $(document).on('click', '.deleteSvm-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('svm.delete', ':replaceThis') }}", reloadSvm )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
