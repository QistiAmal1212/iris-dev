<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-spm-info" role="tab" id="academic-spm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Pelajaran <br> Malaysia/ <br>
                        SPM <br> Vokasional
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_spm1" hidden>Tiada Maklumat</span>
                        {{-- <input type="hidden" name="tm_spm1_hidden" id="tm_spm1_hidden" value=1> --}}
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
                        Sijil <br> Vokasional <br> Malaysia
                    </span>

                    {{-- BADGE IF NO DATA STARTS HERE --}}
                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_svm1" hidden>Tiada Maklumat</span>
                        {{-- <input type="hidden" name="tm_svm1_hide" id= "tm_svm1_hide" value=1> --}}
                    </span>
                    {{-- UNTIL HERE --}}
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-spmu-info" role="tab" id="academic-spmu-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPMU
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        SPM <br> Ulangan
                    </span>
                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_spmu" hidden>Tiada Maklumat</span>
                        {{-- <input type="hidden" name="tm_spmu_hidden" id="tm_spmu_hidden" value=1> --}}
                    </span>
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
<!--                     <div class="row">
                         <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_spm1" name="tahun_spm1" disabled>
                        </div>
                    </div>
 -->                    <div class="row">
                        <input type="hidden" name="spm1_no_pengenalan" id="spm1_no_pengenalan" value="">
                        <input type="hidden" name="id_spm1" id="id_spm1" value="">
<!--
                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" id="subjek_spm1" name="subjek_spm1" disabled onchange="changesubjeckspm('subjek_spm1')">
                                <option value="" hidden></option>
                                    @foreach($subjekSpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>
                             <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">MP Kpd</label>
                            <input type="text" class="form-control" value="" id="mp_kod_spm1" name="mp_kod_spm1" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" id="gred_spm1" name="gred_spm1" disabled>
                                <option value="" hidden></option>
                                    @foreach($gredSpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div> -->


                        <div id="button_action_spm1" style="display:none">
                            <button type="button" id="btnEditSpm1" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSpm1()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-success float-right" id="btnSaveSpm1" onclick="$('#btnEditSpm1').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button> -->
                                <button type="button" class="btn btn-success float-right" id="btnSaveSpm1" onclick="confirmSubmitspm('btnEditSpm1', {
                                          subjek_spm1: $('#subjek_spm1').find(':selected').text(),
                                            gred_spm1: $('#gred_spm1').find(':selected').text(),
                                            tahun_spm1: $('#tahun_spm1').val()
                                        },{
                                            subjek_spm1: 'Matapelajaran',
                                            gred_spm1: 'Gred',
                                            tahun_spm1: 'Tahun'
                                        }
                                    );">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tukar_log_spm1"  id="tukar_log_spm1">
                    </form>
                    <input type="hidden" name="editbutton_spm1" value=0 id="editbutton_spm1">
                    <textarea id="currentvalues_spm1" style="display:none;"></textarea>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-spm1">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <!-- <th>Jenis Peperiksaan</th> -->
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <!-- <th>Kemaskini</th> -->
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
                  <!--   <div class="row">
                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_spm2" name="tahun_spm2" disabled>
                        </div>
                    </div> -->
                   <div class="row">
                        <input type="hidden" name="spm2_no_pengenalan" id="spm2_no_pengenalan" value="">
                        <input type="hidden" name="id_spm2" id="id_spm2" value="">

                        <!-- <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" id="subjek_spm2" name="subjek_spm2" disabled onchange="changesubjeckspm('subjek_spm2')">
                                <option value="" hidden></option>
                                    @foreach($subjekSpm as $subjek)
                                        <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">MP Kod</label>
                            <input type="text" class="form-control" value="" id="mp_kod_spm2" name="mp_kod_spm2" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" id="gred_spm2" name="gred_spm2" disabled>
                                <option value="" hidden></option>
                                    @foreach($gredSpm as $gred)
                                        <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                    @endforeach
                            </select>
                        </div> -->

                        <div id="button_action_spm2" style="display:none">
                            <button type="button" id="btnEditSpm2" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSpm2()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-success float-right" id="btnSaveSpm2" onclick="$('#btnEditSpm2').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button> -->
                                <button type="button" class="btn btn-success float-right" id="btnSaveSpm2" onclick="confirmSubmitspm('btnEditSpm2', {
                                          subjek_spm2: $('#subjek_spm2').find(':selected').text(),
                                            gred_spm2: $('#gred_spm2').find(':selected').text(),
                                            tahun_spm2: $('#tahun_spm2').val()
                                        },{
                                            subjek_spm2: 'Matapelajaran',
                                            gred_spm2: 'Gred',
                                            tahun_spm2: 'Tahun'
                                        }
                                    );">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tukar_log_spm2"  id="tukar_log_spm2">
                    </form>
                    <input type="hidden" name="editbutton_spm2" value=0 id="editbutton_spm2">
                    <textarea id="currentvalues_spm2" style="display:none;"></textarea>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-spm2">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <!-- <th>Jenis Peperiksaan</th> -->
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <!-- <th>Kemaskini</th> -->
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

                   <!--  <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
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
                    </div> -->

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
                            <!-- <th>Jenis Peperiksaan</th> -->
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                            <th>Tahun</th>
                            <!-- <th>Kemaskini</th> -->
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
                                {{-- <button type="button" class="btn btn-danger me-1" onclick="reloadSvm()">
                                    <i class="fa fa-refresh"></i>
                                </button> --}}
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
                                <!-- <th>Jenis Peperiksaan</th> -->
                                <th>Kod MP</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <!-- {{-- <th>Kemaskini</th> --}} -->
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
            <form id="spmuForm" action="" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="" data-reloadPage="false">
                @csrf
                <div class="row">
                    <input type="hidden" name="spmu_no_pengenalan" id="spmu_no_pengenalan" value="">
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
                <table class="table header_uppercase table-bordered table-hovered" id="table-spmu">
                    <thead>
                        <tr>
                            <th>Bil.</th>
                            <!-- <th>Jenis Peperiksaan</th> -->
                            <th>Tahun</th>
                            <th>Kod MP</th>
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    function changesubjeckspm(event) {
        var value = $('#'+event).val();
        var text = $('#'+event).text();
        if (value == '') {
            return ;
        }
        if (event == 'subjek_spm1') {
            $('#mp_kod_spm1').val(value);
        } else {
            $('#mp_kod_spm2').val(value);
        }
    }

    function confirmSubmitspm(btnName, newValues, columnHead) {
        if (btnName == 'btnEditSpm1') {
            var originalVal = JSON.parse($('#currentvalues_spm1').val());
        } else {
            var originalVal = JSON.parse($('#currentvalues_spm2').val());
        }
        var htmlContent = '<p>Perubahan:</p>';
        for (var key in originalVal) {
            if (originalVal.hasOwnProperty(key)) {
                if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
                    if (originalVal[key] == null || originalVal[key] === '') {
                        if (newValues[key] !== 'Tiada Maklumat') {
                            if(newValues[key] !== null){
                                htmlContent += '<p>' + columnHead[key] + ':<br>';
                                htmlContent += 'Tiada Maklumat kepada ' + newValues[key] + '</p>';
                            }
                        }
                    } else {
                        htmlContent += '<p>' + columnHead[key] + ':<br>';
                        htmlContent += originalVal[key] + ' kepada ' + newValues[key] + '</p>';
                    }
                }
            }
        }
         if (htmlContent === '<p>Perubahan:</p>') {
            Swal.fire({
                title: 'Tiada Perubahan Dibuat',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        } else {
            if (btnName == 'btnEditSpm1') {
                $('#tukar_log_spm1').val(htmlContent);
                $('#btnEditSpm1').trigger('click');
            } else {
                $('#tukar_log_spm2').val(htmlContent);
                $('#btnEditSpm2').trigger('click');
            }
        }
        if (btnName == 'btnEditSpm1') {
            $('#editbutton_spm1').val(0);
            reloadSpm1();
            disbalefieldsspm('spm1');
        } else {
            disbalefieldsspm('spm2');
            $('#editbutton_spm2').val(0);
            reloadSpm2();
        }
    }

    function editSpm1() {
        $('#spm1Form select[name="subjek_spm1"]').attr('disabled', false);
        $('#spm1Form select[name="gred_spm1"]').attr('disabled', false);
        $('#spm1Form input[name="tahun_spm1"]').attr('disabled', false);

        $("#button_action_spm1").attr("style", "display:block");

        var editbuttoncount = $('#editbutton_spm1').val();

        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_spm1').val(1)
            var check_data = {
                subjek_spm1: $('#subjek_spm1').find(':selected').text(),
                gred_spm1: $('#gred_spm1').find(':selected').text(),
                tahun_spm1: $('#tahun_spm1').val()
            };
            $('#currentvalues_spm1').val(JSON.stringify(check_data));
        } else {
            checkkemaskinispm('spm1');
        }
    }

    function checkkemaskinispm(type) {
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_'+type).val());

        if (type == 'spm1') {
            if (checkValue.subjek_spm1 != $('#subjek_spm1').find(':selected').text()) {
                datachanged = true;
            }
            if (checkValue.gred_spm1 != $('#gred_spm1').find(':selected').text()) {
                datachanged = true;
            }

            if (checkValue.tahun_spm1 != $('#tahun_spm1').val()) {
                datachanged = true;
            }
        } else {
            if (checkValue.subjek_spm2 != $('#subjek_spm2').find(':selected').text()) {
                datachanged = true;
            }
            if (checkValue.gred_spm2 != $('#gred_spm2').find(':selected').text()) {
                datachanged = true;
            }
            if (checkValue.tahun_spm2 != $('#tahun_spm2').val()) {
                datachanged = true;
            }
        }

        if (!datachanged) {
            $('#editbutton_'+type).val(0);
            disbalefieldsspm(type);
        }
    }

    function disbalefieldsspm(type) {
        if (type == 'spm1') {
            $('#spm1Form select[name="subjek_spm1"]').attr('disabled', true);
            $('#spm1Form select[name="gred_spm1"]').attr('disabled', true);
            $('#spm1Form input[name="tahun_spm1"]').attr('disabled', true);
        } else {
            $('#spm2Form select[name="subjek_spm2"]').attr('disabled', true);
            $('#spm2Form select[name="gred_spm2"]').attr('disabled', true);
            $('#spm2Form input[name="tahun_spm2"]').attr('disabled', true);
        }
        $("#button_action_"+type).attr("style", "display:none");
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
                $('#spm1Form input[name="mp_kod_spm1"]').val('');
                $('#spm1Form select[name="subjek_spm1"]').attr('disabled', true);
                $('#spm1Form select[name="gred_spm1"]').attr('disabled', true);
                $('#spm1Form input[name="tahun_spm1"]').attr('disabled', true);
                $('#spm1Form').attr('action', "{{ route('spm1.store')  }}");
                $('#btnSaveSpm1').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_spm1").attr("style", "display:none");

                $('#table-spm1 tbody').empty();
                var trSpm = '';
                var bilSpm = 0;
                if(data.detail != null){
                    $.each(data.detail, function(i, item) {
                        if (item.data.subject_form5 != null) {
                            if (bilSpm == 0) {
                                trSpm += '<tr>';
                                trSpm += '<td align="left" colspan="5"><b> Tahun : ' + item.data.tahun + '</b></td>';
                                trSpm += '</tr>';
                                trSpm += '<tr>';
                                trSpm += '<td align="left" colspan="5"><b> Jenis Peperiksaan : '+ item.jenis +'</b></td>';
                                trSpm += '</tr>';
                            }
                            bilSpm += 1;
                            trSpm += '<tr>';
                            trSpm += '<td align="center">' + bilSpm + '</td>';
                            // trSpm += '<td>SPM</td>';
                            trSpm += '<td>' + item.data.subject_form5.kod + '</td>'; //KOD MATA PELAJARAN
                            trSpm += '<td>' + item.data.subject_form5.diskripsi + '</td>';
                            trSpm += '<td align="center">' + item.data.gred + '</td>';
                            trSpm += '<td align="center" style="display:none;">' + item.data.tahun + '</td>';
                            // trSpm += '<td align="center"><a><i class="fas fa-pencil text-primary editSpm1-btn" data-id="' + item.id + ' "></i></a>';
                            // trSpm += '&nbsp;&nbsp;';
                            // trSpm += '<a><i class="fas fa-trash text-danger deleteSpm1-btn" data-id="' + item.id + '"></i></a></td>';

                            trSpm += '</tr>';
                        }
                    });
                }
                $('#table-spm1 tbody').append(trSpm);

                if($('#table-spm1 tbody').is(':empty')){
                    var trSpm = '<tr><td align="center" colspan="5">Tiada Maklumat</td></tr>';
                    $('#table-spm1 tbody').append(trSpm);

                    var tmSpm1Element = $("#tm_spm1");
                    tmSpm1Element.removeAttr("hidden");
                    // $('#tm_spm1_hidden').val(0)
                }else{
                    var tmSpm1Element = $("#tm_spm1");
                    tmSpm1Element.attr("hidden", true);
                    // $('#tm_spm1_hidden').val(1)
                }

                $(document).on('click', '.editSpm1-btn', function() {
                     $('#editbutton_spm1').val(0)
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
                    $('#spm1Form input[name="mp_kod_spm1"]').val($(row).find('td:nth-child(2)').text());
                    $('#spm1Form input[name="tahun_spm1"]').val($(row).find('td:nth-child(5)').text());
                    editSpm1();

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
        var editbuttoncount = $('#editbutton_spm2').val();

        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_spm2').val(1)
            var check_data = {
                subjek_spm2: $('#subjek_spm2').find(':selected').text(),
                gred_spm2: $('#gred_spm2').find(':selected').text(),
                tahun_spm2: $('#tahun_spm2').val()
            };
            $('#currentvalues_spm2').val(JSON.stringify(check_data));
        } else {
            checkkemaskinispm('spm2');
        }
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
                $('#spm2Form input[name="mp_kod_spm2"]').val('');
                $('#spm2Form select[name="subjek_spm2"]').attr('disabled', true);
                $('#spm2Form select[name="gred_spm2"]').attr('disabled', true);
                $('#spm2Form input[name="tahun_spm2"]').attr('disabled', true);
                $('#spm2Form').attr('action', "{{ route('spm2.store')  }}");
                $('#btnSaveSpm2').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_spm2").attr("style", "display:none");

                $('#table-spm2 tbody').empty();
                var trSpm = '';
                var bilSpm = 0;
                if(data.detail != null){
                    $.each(data.detail, function(i, item) {
                        if (item.data.subject_form5 != null) {
                            if (bilSpm == 0) {
                                trSpm += '<tr>';
                                trSpm += '<td align="left" colspan="5"><b>' + item.data.tahun + '</b></td>';
                                trSpm += '</tr>';
                                trSpm += '<tr>';
                                trSpm += '<td align="left" colspan="5"><b> Jenis Peperiksaan : '+ item.jenis +'</b></td>';
                                trSpm += '</tr>';
                            }
                            bilSpm += 1;
                            trSpm += '<tr>';
                            trSpm += '<td align="center">' + bilSpm + '</td>';
                            // trSpm += '<td>SPM</td>'; //KOD MATA PELAJARAN
                            trSpm += '<td>' + item.data.subject_form5.kod + '</td>'; //KOD MATA PELAJARAN
                            trSpm += '<td>' + item.data.subject_form5.diskripsi + '</td>';
                            trSpm += '<td align="center">' + item.data.gred + '</td>';
                            trSpm += '<td align="center" style="display:none;">' + item.data.tahun + '</td>';
                            // trSpm += '<td align="center"><a><i class="fas fa-pencil text-primary editSpm2-btn" data-id="' + item.id + ' "></i></a>';
                            // trSpm += '&nbsp;&nbsp;';
                            // trSpm += '<a><i class="fas fa-trash text-danger deleteSpm2-btn" data-id="' + item.id + '"></i></a></td>';
                            trSpm += '</tr>';
                        }
                    });
                }
                $('#table-spm2 tbody').append(trSpm);

                if($('#table-spm2 tbody').is(':empty')){
                    var trSpm = '<tr><td align="center" colspan="5">Tiada Maklumat</td></tr>';
                    $('#table-spm2 tbody').append(trSpm);
                }

                $(document).on('click', '.editSpm2-btn', function() {
                     $('#editbutton_spm2').val(0)
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
                    $('#spm2Form input[name="mp_kod_spm2"]').val($(row).find('td:nth-child(2)').text());
                    $('#spm2Form input[name="tahun_spm2"]').val($(row).find('td:nth-child(5)').text());
                    editSpm2();
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

                $('#svmForm select[name="kelulusan_svm"]').val('').trigger('change');
                $('#svmForm select[name="subjek_svm"]').val('').trigger('change');
                $('#svmForm select[name="gred_svm"]').val('').trigger('change');
                $('#svmForm input[name="tahun_svm"]').val('');
                $('#svmForm input[name="pngka_svm"]').val('');
                $('#svmForm input[name="pngkv_svm"]').val('');

                if(data.detail != null) {
                $('#svmForm select[name="kelulusan_svm"]').val(data.detail.kel1_kod).trigger('change');
                $('#svmForm select[name="subjek_svm"]').val(data.detail.mata_pelajaran).trigger('change');
                $('#svmForm select[name="gred_svm"]').val(data.detail.gred).trigger('change');
                $('#svmForm input[name="tahun_svm"]').val(data.detail.tahun_lulus);
                $('#svmForm input[name="pngka_svm"]').val(data.detail.pngka);
                $('#svmForm input[name="pngkv_svm"]').val(data.detail.pngkv);
                }

                $('#svmForm select[name="kelulusan_svm"]').attr('disabled', true);
                $('#svmForm select[name="subjek_svm"]').attr('disabled', true);
                $('#svmForm select[name="gred_svm"]').attr('disabled', true);
                $('#svmForm input[name="tahun_svm"]').attr('disabled', true);
                $('#svmForm input[name="pngka_svm"]').attr('disabled', true);
                $('#svmForm input[name="pngkv_svm"]').attr('disabled', true);
                $('#svmForm').attr('action', "{{ route('svm.store')  }}");
                $('#btnSaveSvm').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_svm").attr("style", "display:none");

                $('#table-svm tbody').empty();
                var trSvm = '';
                var bilSvm = 0;
                //$.each(data.detail, function(i, item) {

                if(data.detail != null) {
                    if(data.detail.subject != null) {
                        if ( bilSvm == 0) {
                             trSvm += '<tr>';
                trSvm += '<td align="left" colspan="5"><b> Jenis Peperiksaan : SVM</b></td>';
                trSvm += '</tr>';
                        }
                        bilSvm += 1;
                        trSvm += '<tr>';
                        trSvm += '<td align="center">' + bilSvm + '</td>';
                        // trSvm += '<td>SVM</td>';
                        trSvm += '<td>' + data.detail.subject.kod + '</td>'; //KOD MATA PELAJARAN
                        trSvm += '<td>' + data.detail.subject.diskripsi + '</td>';
                        trSvm += '<td align="center">' + data.detail.gred + '</td>';
                        // trSvm += '<td align="center"><i class="fas fa-pencil text-primary editSvm-btn" data-id="' + item.id + ' "></i>';
                        // trSvm += '&nbsp;&nbsp;';
                        // trSvm += '<i class="fas fa-trash text-danger deleteSvm-btn" data-id="' + item.id + '"></i></td>';
                        trSvm += '</tr>';
                    }
                }
                //});
                $('#table-svm tbody').append(trSvm);

                if($('#table-svm tbody').is(':empty')){
                    var trSvm = '<tr><td align="center" colspan="5">Tiada Maklumat</td></tr>';
                    $('#table-svm tbody').append(trSvm);

                    var tmSvm1Element = $("#tm_svm1");
                    tmSvm1Element.removeAttr("hidden");
                }else{
                    // $('#tm_svm1_hidden').val(1)
                    var tmSvm1Element = $("#tm_svm1");
                    tmSvm1Element.attr("hidden", true);
                    // var tmSvm1Element = $("#tm_svm_spm");
                    // tmSvm1Element.attr("hidden", true);
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
    function reloadSpmu() {
        var no_pengenalan = $('#spmu_no_pengenalan').val();
        $('#spmuForm input[name="spmu_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmuUrl = "{{ route('spmu.list', ':replaceThis') }}"
        reloadSpmuUrl = reloadSpmuUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmuUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#table-spmu tbody').empty();
                var trSpmu = '';
                var bilSpmu = 0;
                if(data.detail != null){

                    $.each(data.detail, function(i, item) {
                        if(item.subjek != null) {
                            if (bilSpmu == 0) {
                                trSpmu += '<tr>';
                                trSpmu += '<td align="left" colspan="5"><b> Jenis Peperiksaan : SPMU</b></td>';
                                trSpmu += '</tr>';
                            }
                            bilSpmu += 1;
                            trSpmu += '<tr>';
                            trSpmu += '<td align="center">' + bilSpmu + '</td>';
                            trSpmu += '<td align="center">' + item.tahun + '</td>';
                            trSpmu += '<td>' + item.subjek.kod + '</td>'; //KOD MATA PELAJARAN
                            trSpmu += '<td>' + item.subjek.diskripsi + '</td>';
                            trSpmu += '<td align="center">' + item.gred + '</td>';
                            trSpmu += '</tr>';
                        }
                    });
                }
                $('#table-spmu tbody').append(trSpmu);

                if($('#table-spmu tbody').is(':empty')){
                    var trSpmu = '<tr><td align="center" colspan="5">Tiada Maklumat</td></tr>';
                    $('#table-spmu tbody').append(trSpmu);

                    var tmSpmuElement = $("#tm_spmu");
                    tmSpmuElement.removeAttr("hidden");
                    // $('#tm_smpu_hidden').val(0)
                    // if ($('#tm_spm1_hidden').val() == 0) {
                    //     var tmSpmuElement = $("#tm_svm_spm");
                    //     tmSpmuElement.removeAttr("hidden");
                    // }
                }else{
                    // $('#tm_spmu_hidden').val(1)
                    var tmSpmuElement = $("#tm_spmu");
                    tmSpmuElement.attr("hidden", true);
                    // var tmSpmuElement = $("#tm_svm_spm");
                    // tmSpmuElement.attr("hidden", true);
                }

                var badgeSpm = document.getElementById('tm_spm1');
                var badgeSvm = document.getElementById('tm_svm1');
                var badgeSpmu = document.getElementById('tm_spmu');

                if (!badgeSpm.hidden && !badgeSvm.hidden && !badgeSpmu.hidden) {
                    var spmTab = document.getElementById('tm_svm_spm');
                    spmTab.hidden = false;
                }else{
                    var spmTab = document.getElementById('tm_svm_spm');
                    spmTab.hidden = true;
                }
            },
            error: function(data) {
            }
        });
    }
</script>
