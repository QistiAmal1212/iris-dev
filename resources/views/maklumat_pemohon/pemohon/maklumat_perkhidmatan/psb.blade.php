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
                        Tempat Bertugas Terkini
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- PSB/PSL --}}
        <div id="perkhidmatan-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-info-trigger">
            <div class="accordion" id="accordion_psb_psl">
                {{-- PSB/PSL --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_psb">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#psb_info" aria-expanded="true" aria-controls="psb_info">
                            Maklumat PSB/PSL
                        </button>
                    </h2>
                    <div id="psb_info" class="accordion-collapse collapse show" aria-labelledby="heading_psb" data-bs-parent="#accordion_psb_psl">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end align-items-center mb-1" id="update_experience" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editExperience()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            <form id="experienceForm" action="{{ route('experience.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadExperience" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="experience_no_pengenalan" id="experience_no_pengenalan" value="">

                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Jenis Perkhidmatan</label>
                                        <input type="text" class="form-control" value="" disabled>
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
                                                    <option value="{{ $positionLevel->code }}">{{ $positionLevel->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="button_action_experience" style="display:none">
                                    <button type="button" id="btnEditExperience" hidden onclick="generalFormSubmit(this);"></button>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperience', {
                                            experience_appoint_date: $('#experience_appoint_date').val(),
                                            experience_position_level: $('#experience_position_level').find(':selected').text(),
                                            // experience_skim: $('#experience_skim').find(':selected').text(),
                                            // experience_start_date: $('#experience_start_date').val(),
                                            // experience_verify_date: $('#experience_verify_date').val(),
                                            // experience_department_ministry: $('#experience_department_ministry').find(':selected').text(),
                                            // experience_department_state: $('#experience_department_state').find(':selected').text(),
                                        },{
                                            experience_appoint_date: 'Tarikh Lantikan Pertama',
                                            experience_position_level: 'Taraf Jawatan',
                                            // experience_skim: 'Skim Perkhidmatan',
                                            // experience_start_date: 'Tarikh Lantikan',
                                            // experience_verify_date: 'Tarikh Pengesahan Lantikan',
                                            // experience_department_ministry: 'Kementerian/Jabatan',
                                            // experience_department_state: 'Negeri',
                                        }
                                        );">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form> {{-- TUTUP FORM DISINI --}}
                        </div>
                    </div>
                </div>

                {{-- PSB/PSL HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_psb">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_psb" aria-expanded="false" aria-controls="history_psb">
                            Jejak Audit [PSB/PSL]
                        </button>
                    </h2>
                    <div id="history_psb" class="accordion-collapse collapse" aria-labelledby="heading_history_psb" data-bs-parent="#accordion_psb_psl">
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
        </div>

        {{-- Perkhidmatan Sekarang (Hakiki) --}}
        <div id="perkhidmatan-hakiki-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-hakiki-info-trigger">
            <div class="accordion" id="accordion_perkhidmatan_hakiki">
                {{-- Perkhidmatan Sekarang (Hakiki) --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_hakiki">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#perkhidmatan_hakiki" aria-expanded="true" aria-controls="perkhidmatan_hakiki">
                            Perkhidmatan Sekarang (Hakiki)
                        </button>
                    </h2>
                    <div id="perkhidmatan_hakiki" class="accordion-collapse collapse show" aria-labelledby="heading_hakiki" data-bs-parent="#accordion_perkhidmatan_hakiki">
                        <div class="accordion-body">
                            {{-- Button kemaskini perkhidmatan hakiki --}}
                            <div class="d-flex justify-content-end align-items-center mb-1" id="" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editExperienceH()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            {{-- Form perkhidmatan hakiki --}}
                            <form id="experienceHForm" action="{{ route('experienceH.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadExperienceH" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
                                        <label class="form-label">Skim Perkhidmatan</label>
                                        <select class="select2 form-control" name="experience_skim" id="experience_skim" disabled>
                                            <option value="" hidden>Skim Perkhidmatan</option>
                                                @foreach($skims as $skim)
                                                    <option value="{{ $skim->code }}">{{ $skim->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                                        <label class="form-label">Gred Jawatan</label>
                                        <input type="text" class="form-control" value="" disabled>
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
                                <div id="button_action_experienceH" style="display:none">
                                    <button type="button" id="btnEditExperienceH" hidden onclick="generalFormSubmit(this);"></button>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperienceH', {
                                            // experience_appoint_date: $('#experience_appoint_date').val(),
                                            // experience_position_level: $('#experience_position_level').find(':selected').text(),
                                            experience_skim: $('#experience_skim').find(':selected').text(),
                                            experience_start_date: $('#experience_start_date').val(),
                                            experience_verify_date: $('#experience_verify_date').val(),
                                            // experience_department_ministry: $('#experience_department_ministry').find(':selected').text(),
                                            // experience_department_state: $('#experience_department_state').find(':selected').text(),
                                        },{
                                            // experience_appoint_date: 'Tarikh Lantikan Pertama',
                                            // experience_position_level: 'Taraf Jawatan',
                                            experience_skim: 'Skim Perkhidmatan',
                                            experience_start_date: 'Tarikh Lantikan',
                                            experience_verify_date: 'Tarikh Pengesahan Lantikan',
                                            // experience_department_ministry: 'Kementerian/Jabatan',
                                            // experience_department_state: 'Negeri',
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

                {{-- Perkhidmatan Sekarang (Hakiki) HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_hakiki">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_hakik" aria-expanded="false" aria-controls="history_hakik">
                            Jejak Audit [Perkhidmatan Sekarang (Hakiki)]
                        </button>
                    </h2>
                    <div id="history_hakik" class="accordion-collapse collapse" aria-labelledby="heading_history_hakiki" data-bs-parent="#accordion_perkhidmatan_hakiki">
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
        </div>

        {{-- Tempat Bertugas Terkini --}}
        <div id="tempat-bertugas-info" class="content parent-tab" role="tabpanel" aria-labelledby="tempat-bertugas-info-trigger">
            <div class="accordion" id="accordion_tempat_bertugas">
                {{-- Tempat Bertugas Terkini --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_tempat_bertugas">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#tempat_bertugas" aria-expanded="true" aria-controls="tempat_bertugas">
                            Tempat Bertugas Terkini
                        </button>
                    </h2>
                    <div id="tempat_bertugas" class="accordion-collapse collapse show" aria-labelledby="heading_tempat_bertugas" data-bs-parent="#accordion_tempat_bertugas">
                        <div class="accordion-body">
                            {{-- Button kemaskini tempat bertugas --}}
                            <div class="d-flex justify-content-end align-items-center mb-1" id="" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editExperienceB()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            {{-- Form tempat bertugas --}}
                            <form id="experienceBForm" action="{{ route('experienceB.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadExperienceB" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Kementerian/ Jabatan</label>
                                        <select class="select2 form-control" name="experience_department_ministry" id="experience_department_ministry" disabled>
                                            <option value="" hidden>Kementerian/ Jabatan</option>
                                                @foreach($departmentMinistries as $departmentMinistry)
                                                    <option value="{{ $departmentMinistry->kod }}">{{ $departmentMinistry->nama }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                        <label class="form-label">Negeri</label>
                                        <select class="select2 form-control" name="experience_department_state" id="experience_department_state" disabled>
                                            <option value="" hidden>Negeri</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                        <label class="form-label">Daerah</label>
                                        <input type="text" class="form-control" value="" disabled>
                                    </div>
                                </div>
                                <div id="button_action_experienceB" style="display:none">
                                    <button type="button" id="btnEditExperienceB" hidden onclick="generalFormSubmit(this);"></button>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperienceB', {
                                            // experience_appoint_date: $('#experience_appoint_date').val(),
                                            // experience_position_level: $('#experience_position_level').find(':selected').text(),
                                            // experience_skim: $('#experience_skim').find(':selected').text(),
                                            // experience_start_date: $('#experience_start_date').val(),
                                            // experience_verify_date: $('#experience_verify_date').val(),
                                            experience_department_ministry: $('#experience_department_ministry').find(':selected').text(),
                                            experience_department_state: $('#experience_department_state').find(':selected').text(),
                                        },{
                                            // experience_appoint_date: 'Tarikh Lantikan Pertama',
                                            // experience_position_level: 'Taraf Jawatan',
                                            // experience_skim: 'Skim Perkhidmatan',
                                            // experience_start_date: 'Tarikh Lantikan',
                                            // experience_verify_date: 'Tarikh Pengesahan Lantikan',
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

                {{-- Tempat Bertugas Terkini HISTORY --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_tempat_bertugas">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_tempat_bertugas" aria-expanded="false" aria-controls="history_tempat_bertugas">
                            Jejak Audit [Tempat Bertugas Terkini]
                        </button>
                    </h2>
                    <div id="history_tempat_bertugas" class="accordion-collapse collapse" aria-labelledby="heading_history_tempat_bertugas" data-bs-parent="#accordion_tempat_bertugas">
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
        </div>
    </div>
</div>

{{-- IDK WHERE TO PASTE THIS --}}


<script>

    function editExperience() {
        $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', false);
        $('#experienceForm select[name="experience_position_level"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_skim"]').attr('disabled', false);
        // $('#experienceForm input[name="experience_start_date"]').attr('disabled', false);
        // $('#experienceForm input[name="experience_verify_date"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_department_state"]').attr('disabled', false);

        $("#button_action_experience").attr("style", "display:block");
    }

    function reloadExperience() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experience.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.tarikh_lantik);
                $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                $('#experienceForm select[name="experience_position_level"]').val(data.detail.taraf_jawatan).trigger('change');
                $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_skim"]').val(data.detail.kod_ruj_skim).trigger('change');
                // $('#experienceForm select[name="experience_skim"]').attr('disabled', true);
                // $('#experienceForm input[name="experience_start_date"]').val(data.detail.tarikh_mula);
                // $('#experienceForm input[name="experience_start_date"]').attr('disabled', true);
                // $('#experienceForm input[name="experience_verify_date"]').val(data.detail.tarikh_disahkan);
                // $('#experienceForm input[name="experience_verify_date"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.ruj_kem_jabatan).trigger('change');
                // $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_department_state"]').val(data.detail.negeri_jabatan).trigger('change');
                // $('#experienceForm select[name="experience_department_state"]').attr('disabled', true);

                $("#button_action_experience").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editExperienceH() {
        // $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_position_level"]').attr('disabled', false);
        $('#experienceHForm select[name="experience_skim"]').attr('disabled', false);
        $('#experienceHForm input[name="experience_start_date"]').attr('disabled', false);
        $('#experienceHForm input[name="experience_verify_date"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_department_state"]').attr('disabled', false);

        $("#button_action_experienceH").attr("style", "display:block");
    }

    function reloadExperienceH() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experienceH.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                // $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.tarikh_lantik);
                // $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_position_level"]').val(data.detail.taraf_jawatan).trigger('change');
                // $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                $('#experienceHForm select[name="experience_skim"]').val(data.detail.kod_ruj_skim).trigger('change');
                $('#experienceHForm select[name="experience_skim"]').attr('disabled', true);
                $('#experienceHForm input[name="experience_start_date"]').val(data.detail.tarikh_mula);
                $('#experienceHForm input[name="experience_start_date"]').attr('disabled', true);
                $('#experienceHForm input[name="experience_verify_date"]').val(data.detail.tarikh_disahkan);
                $('#experienceHForm input[name="experience_verify_date"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.ruj_kem_jabatan).trigger('change');
                // $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_department_state"]').val(data.detail.negeri_jabatan).trigger('change');
                // $('#experienceForm select[name="experience_department_state"]').attr('disabled', true);

                $("#button_action_experienceH").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editExperienceB() {
        // $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_position_level"]').attr('disabled', false);
        // $('#experienceForm select[name="experience_skim"]').attr('disabled', false);
        // $('#experienceForm input[name="experience_start_date"]').attr('disabled', false);
        // $('#experienceForm input[name="experience_verify_date"]').attr('disabled', false);
        $('#experienceBForm select[name="experience_department_ministry"]').attr('disabled', false);
        $('#experienceBForm select[name="experience_department_state"]').attr('disabled', false);

        $("#button_action_experienceB").attr("style", "display:block");
    }

    function reloadExperienceB() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadExperienceUrl = "{{ route('experienceB.details', ':replaceThis') }}"
        reloadExperienceUrl = reloadExperienceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadExperienceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                // $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.tarikh_lantik);
                // $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_position_level"]').val(data.detail.taraf_jawatan).trigger('change');
                // $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                // $('#experienceForm select[name="experience_skim"]').val(data.detail.kod_ruj_skim).trigger('change');
                // $('#experienceForm select[name="experience_skim"]').attr('disabled', true);
                // $('#experienceForm input[name="experience_start_date"]').val(data.detail.tarikh_mula);
                // $('#experienceForm input[name="experience_start_date"]').attr('disabled', true);
                // $('#experienceForm input[name="experience_verify_date"]').val(data.detail.tarikh_disahkan);
                // $('#experienceForm input[name="experience_verify_date"]').attr('disabled', true);
                $('#experienceBForm select[name="experience_department_ministry"]').val(data.detail.ruj_kem_jabatan).trigger('change');
                $('#experienceBForm select[name="experience_department_ministry"]').attr('disabled', true);
                $('#experienceBForm select[name="experience_department_state"]').val(data.detail.negeri_jabatan).trigger('change');
                $('#experienceBForm select[name="experience_department_state"]').attr('disabled', true);

                $("#button_action_experienceB").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
