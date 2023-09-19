<div class="card" id="update_experience" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editExperience()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="experienceForm"
action="{{ route('experience.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadExperience"
data-reloadPage="false">
@csrf
<div class="row">
    <input type="hidden" name="experience_no_pengenalan" id="experience_no_pengenalan" value="">
    {{-- MAKLUMAT PSB/PSL --}}
    {{-- <h6>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6> --}}
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
            <option value=""></option>
            @foreach($positionLevels as $positionLevel)
            <option value="{{ $positionLevel->code }}">{{ $positionLevel->name }}</option>
            @endforeach
        </select>
    </div>

    <hr>

    {{-- PERKHIDMATAN SEKARANG --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder mt-1">Perkhidmatan Sekarang (Hakiki)</span>
    </h6>
    <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
        <label class="form-label">Skim Perkhidmatan</label>
        <select class="select2 form-control" name="experience_skim" id="experience_skim" disabled>
            <option value=""></option>
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

    {{-- TEMPAT BERTUGAS TERKINI --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder mt-1">Tempat Bertugas Terkini</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Kementerian/ Jabatan</label>
        <select class="select2 form-control" name="experience_department_ministry" id="experience_department_ministry" disabled>
            <option value=""></option>
            @foreach($departmentMinistries as $departmentMinistry)
            <option value="{{ $departmentMinistry->code }}">{{ $departmentMinistry->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="experience_department_state" id="experience_department_state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Daerah</label>
        <input type="text" class="form-control" value="" disabled>
    </div>
</div>
<div id="button_action_experience" style="display:none">
    <button type="button" id="btnEditExperience" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditExperience', {
            experience_appoint_date: $('#experience_appoint_date').val(),
            experience_position_level: $('#experience_position_level').val(),
            experience_skim: $('#experience_skim').val(),
            experience_start_date: $('#experience_start_date').val(),
            experience_verify_date: $('#experience_verify_date').val(),
            experience_department_ministry: $('#experience_department_ministry').val(),
            experience_department_state: $('#experience_department_state').val(),
        },{
            experience_appoint_date: 'Tarikh Lantikan Pertama',
            experience_position_level: 'Taraf Jawatan',
            experience_skim: 'Skim Perkhidmatan',
            experience_start_date: 'Tarikh Lantikan',
            experience_verify_date: 'Tarikh Pengesahan Lantikan',
            experience_department_ministry: 'Kementerian/Jabatan',
            experience_department_state: 'Negeri',
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>

<script>

    function editExperience() {
        $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', false);
        $('#experienceForm select[name="experience_position_level"]').attr('disabled', false);
        $('#experienceForm select[name="experience_skim"]').attr('disabled', false);
        $('#experienceForm input[name="experience_start_date"]').attr('disabled', false);
        $('#experienceForm input[name="experience_verify_date"]').attr('disabled', false);
        $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', false);
        $('#experienceForm select[name="experience_department_state"]').attr('disabled', false);

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
                $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.date_appoint);
                $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                $('#experienceForm select[name="experience_position_level"]').val(data.detail.ref_position_level_code).trigger('change');
                $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                $('#experienceForm select[name="experience_skim"]').val(data.detail.ref_skim_code).trigger('change');
                $('#experienceForm select[name="experience_skim"]').attr('disabled', true);
                $('#experienceForm input[name="experience_start_date"]').val(data.detail.date_start);
                $('#experienceForm input[name="experience_start_date"]').attr('disabled', true);
                $('#experienceForm input[name="experience_verify_date"]').val(data.detail.date_verify);
                $('#experienceForm input[name="experience_verify_date"]').attr('disabled', true);
                $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.ref_department_ministry_code).trigger('change');
                $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', true);
                $('#experienceForm select[name="experience_department_state"]').val(data.detail.state_department).trigger('change');
                $('#experienceForm select[name="experience_department_state"]').attr('disabled', true);

                $("#button_action_experience").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
