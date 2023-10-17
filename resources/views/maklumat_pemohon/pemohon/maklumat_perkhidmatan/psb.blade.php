<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#perkhidmatan-info" role="tab" id="perkhidmatan-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    A
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        PSB/PSL
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_mpsb" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#perkhidmatan-hakiki-info" role="tab" id="perkhidmatan-hakiki-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    B
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Perkhidmatan Sekarang (Hakiki)
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_hakiki" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#tempat-bertugas-info" role="tab" id="tempat-bertugas-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    C
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Tempat Bertugas <br> Terkini
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_tb" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- PSB/PSL --}}
        <div id="perkhidmatan-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-info-trigger">
            <div id="update_experienceA" style="display:none">
                <div class="d-flex justify-content-end align-items-center mb-1">
                    <a class="me-3 text-danger" type="button" onclick="editExperienceA()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>
            </div>

            <form 
            id="experienceAForm" 
            action="{{ route('experience.update', ['type' => 'A']) }}" 
            method="POST" data-refreshFunctionName="reloadTimeline" 
            data-refreshFunctionNameIfSuccess="reloadExperienceA" 
            data-reloadPage="false">
                @csrf
                <input type="hidden" name="experienceA_no_pengenalan" id="experienceA_no_pengenalan" value="">
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label">Jenis Perkhidmatan</label>
                        <select class="select2 form-control" name="experience_job_sector" id="experience_job_sector" disabled>
                            <option value=""></option>
                            @foreach($sektorPekerjaan as $sektor)
                            <option value="{{ $sektor->kod }}">{{ $sektor->diskripsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Lantikan Pertama</label>
                        <input type="text" class="form-control flatpickr" value="" name="experience_appoint_date" id="experience_appoint_date" oninput="checkInput('experience_appoint_date', 'experience_appoint_dateAlert')" disabled>
                        <div id="experience_appoint_dateAlert" style="color: red; font-size: smaller;"></div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Taraf Jawatan</label>
                        <select class="select2 form-control" name="experience_position_level" id="experience_position_level" disabled>
                            <option value="" hidden>Taraf Jawatan</option>
                                @foreach($positionLevels as $positionLevel)
                                    <option value="{{ $positionLevel->kod }}">{{ $positionLevel->diskripsi }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div id="button_action_experienceA" style="display:none">
                    <button type="button" id="btnEditExperienceA" hidden onclick="generalFormSubmit(this);"></button>
                    <div class="d-flex justify-content-end align-items-center my-1">
                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperienceA', {
                            experience_job_sector: $('#experience_job_sector').find(':selected').text(),
                            experience_appoint_date: $('#experience_appoint_date').val(),
                            experience_position_level: $('#experience_position_level').find(':selected').text(),
                        },{
                            experience_job_sector: 'Jenis Perkhidmatan',
                            experience_appoint_date: 'Tarikh Lantikan Pertama',
                            experience_position_level: 'Taraf Jawatan',
                        }
                        );">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form> {{-- TUTUP FORM DISINI --}}
        </div>

        {{-- Perkhidmatan Sekarang (Hakiki) --}}
        <div id="perkhidmatan-hakiki-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-hakiki-info-trigger">
           {{-- Button kemaskini perkhidmatan hakiki --}}
           <div id="update_experienceB" style="display:none">
            <div class="d-flex justify-content-end align-items-center mb-1">
                    <a class="me-3 text-danger" type="button" onclick="editExperienceB()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>
            </div>

            {{-- Form perkhidmatan hakiki --}}
            <form 
            id="experienceBForm" 
            action="{{ route('experience.update', ['type' => 'B']) }}" 
            method="POST" 
            data-refreshFunctionName="reloadTimeline" 
            data-refreshFunctionNameIfSuccess="reloadExperienceB" 
            data-reloadPage="false">
                @csrf
                <input type="hidden" name="experienceB_no_pengenalan" id="experienceB_no_pengenalan" value="">
                <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
                        <label class="form-label">Skim Perkhidmatan</label>
                        <select class="select2 form-control" name="experience_skim" id="experience_skim" disabled>
                            <option value="" hidden>Skim Perkhidmatan</option>
                            @foreach($skims as $skim)
                                <option value="{{ $skim->kod }}">{{ $skim->diskripsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label">Gred Jawatan</label>
                        <select class="select2 form-control" name="experience_position_grade" id="experience_position_grade" disabled>
                            <option value=""></option>
                            @foreach($gredJawatan as $gred)
                            <option value="{{ $gred->kod }}">{{ $gred->kod }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label">Kumpulan Perkhidmatan</label>
                        <select class="select2 form-control" name="experience_service_group" id="experience_service_group" disabled>
                            <option value=""></option>
                            @foreach($kumpulanPerkhidmatan as $kumpulan)
                            <option value="{{ $kumpulan->kod }}">{{ $kumpulan->diskripsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Lantikan</label>
                        <input type="text" class="form-control flatpickr" value="" name="experience_start_date" id="experience_start_date" oninput="checkInput('experience_start_date', 'experience_start_dateAlert')" disabled>
                        <div id="experience_start_dateAlert" style="color: red; font-size: smaller;"></div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Pengesahan Lantikan</label>
                        <input type="text" class="form-control flatpickr" value="" name="experience_verify_date" id="experience_verify_date" oninput="checkInput('experience_verify_date', 'experience_verify_dateAlert')" disabled>
                        <div id="experience_verify_dateAlert" style="color: red; font-size: smaller;"></div>
                    </div>
                </div>
                <div id="button_action_experienceB" style="display:none">
                    <button type="button" id="btnEditExperienceB" hidden onclick="generalFormSubmit(this);"></button>
                    <div class="d-flex justify-content-end align-items-center my-1">
                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperienceB', {
                            experience_skim: $('#experience_skim').find(':selected').text(),
                            experience_service_group: $('#experience_service_group').find(':selected').text(),
                            experience_position_grade: $('#experience_position_grade').find(':selected').text(),
                            experience_start_date: $('#experience_start_date').val(),
                            experience_verify_date: $('#experience_verify_date').val(),
                        },{
                            experience_skim: 'Skim Perkhidmatan',
                            experience_service_group: 'Kumpulan Perkhidmatan',
                            experience_position_grade: 'Gred Jawatan',
                            experience_start_date: 'Tarikh Lantikan',
                            experience_verify_date: 'Tarikh Pengesahan Lantikan',
                        }
                        );">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tempat Bertugas Terkini --}}
        <div id="tempat-bertugas-info" class="content parent-tab" role="tabpanel" aria-labelledby="tempat-bertugas-info-trigger">
            {{-- Button kemaskini tempat bertugas --}}
            <div id="update_experienceC" style="display:none">
                <div class="d-flex justify-content-end align-items-center mb-1">
                    <a class="me-3 text-danger" type="button" onclick="editExperienceC()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>
            </div>

            {{-- Form tempat bertugas --}}
            <form id="experienceCForm" 
            action="{{ route('experience.update', ['type' => 'C']) }}" 
            method="POST" 
            data-refreshFunctionName="reloadTimeline" 
            data-refreshFunctionNameIfSuccess="reloadExperienceC" 
            data-reloadPage="false">
                @csrf
                <input type="hidden" name="experienceC_no_pengenalan" id="experienceC_no_pengenalan" value="">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label">Kementerian/ Jabatan</label>
                        <select class="select2 form-control" name="experience_department_ministry" id="experience_department_ministry" disabled>
                            <option value="" hidden>Kementerian/ Jabatan</option>
                                @foreach($departmentMinistries as $departmentMinistry)
                                    <option value="{{ $departmentMinistry->kod }}">{{ $departmentMinistry->diskripsi }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Negeri</label>
                        <select class="select2 form-control" name="experience_department_state" id="experience_department_state" disabled>
                            <option value="" hidden>Negeri</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Daerah</label>
                        <input type="text" class="form-control" value="" disabled>
                    </div>
                </div>
                <div id="button_action_experienceC" style="display:none">
                    <button type="button" id="btnEditExperienceC" hidden onclick="generalFormSubmit(this);"></button>
                    <div class="d-flex justify-content-end align-items-center my-1">
                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperienceC', {
                            experience_department_ministry: $('#experience_department_ministry').find(':selected').text(),
                            experience_department_state: $('#experience_department_state').find(':selected').text(),
                        },{
                            experience_department_ministry: 'Kementerian/Jabatan',
                            experience_department_state: 'Negeri',
                        }
                        );">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function editExperienceA() {
        $('#experienceAForm select[name="experience_job_sector"]').attr('disabled', false);
        $('#experienceAForm input[name="experience_appoint_date"]').attr('disabled', false);
        $('#experienceAForm select[name="experience_position_level"]').attr('disabled', false);

        $("#button_action_experienceA").attr("style", "display:block");
    }

    function reloadExperienceA() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experience.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#experienceAForm select[name="experience_job_sector"]').val(data.detail.sektor_pekerjaan).trigger('change');
                $('#experienceAForm select[name="experience_job_sector"]').attr('disabled', true);
                $('#experienceAForm input[name="experience_appoint_date"]').val(data.detail.tarikh_mula);
                $('#experienceAForm input[name="experience_appoint_date"]').attr('disabled', true);
                $('#experienceAForm select[name="experience_position_level"]').val(data.detail.taraf_jawatan).trigger('change');
                $('#experienceAForm select[name="experience_position_level"]').attr('disabled', true);

                $("#button_action_experienceA").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editExperienceB() {
        $('#experienceBForm select[name="experience_skim"]').attr('disabled', false);
        $('#experienceBForm select[name="experience_position_grade"]').attr('disabled', false);
        $('#experienceBForm select[name="experience_service_group"]').attr('disabled', false);
        $('#experienceBForm input[name="experience_start_date"]').attr('disabled', false);
        $('#experienceBForm input[name="experience_verify_date"]').attr('disabled', false);

        $("#button_action_experienceB").attr("style", "display:block");
    }

    function reloadExperienceB() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experience.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#experienceBForm select[name="experience_skim"]').val(data.detail.ski_kod).trigger('change');
                $('#experienceBForm select[name="experience_skim"]').attr('disabled', true);
                $('#experienceBForm select[name="experience_position_grade"]').val(data.detail.ggh_kod).trigger('change');
                $('#experienceBForm select[name="experience_position_grade"]').attr('disabled', true);
                $('#experienceBForm select[name="experience_service_group"]').val(data.detail.kump_pkhidmat).trigger('change');
                $('#experienceBForm select[name="experience_service_group"]').attr('disabled', true);
                $('#experienceBForm input[name="experience_start_date"]').val(data.detail.tarikh_lantik1);
                $('#experienceBForm input[name="experience_start_date"]').attr('disabled', true);
                $('#experienceBForm input[name="experience_verify_date"]').val(data.detail.tarikh_disahkan);
                $('#experienceBForm input[name="experience_verify_date"]').attr('disabled', true);

                $("#button_action_experienceB").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editExperienceC() {
        $('#experienceCForm select[name="experience_department_ministry"]').attr('disabled', false);
        $('#experienceCForm select[name="experience_department_state"]').attr('disabled', false);

        $("#button_action_experienceC").attr("style", "display:block");
    }

    function reloadExperienceC() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experience.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#experienceCForm select[name="experience_department_ministry"]').val(data.detail.kj_kod).trigger('change');
                $('#experienceCForm select[name="experience_department_ministry"]').attr('disabled', true);
                $('#experienceCForm select[name="experience_department_state"]').val(data.detail.negeri_jabatan).trigger('change');
                $('#experienceCForm select[name="experience_department_state"]').attr('disabled', true);

                $("#button_action_experienceC").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

</script>
