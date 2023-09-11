<style>
    .flatpickr-input[disabled]{
        background-color: #efefef;
    }
</style>
<form 
id="personalForm"
action="{{ route('personal.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPersonal" 
data-reloadPage="false">
@csrf
<div id="div_personal">
    <input type="hidden" name="personal_no_pengenalan" id="personal_no_pengenalan" value="">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Jantina</label>
            <select class="select2 form-control" name="gender" id="gender" disabled>
                <option value=""></option>
                @foreach($genders as $gender)
                <option value="{{ $gender->code }}">{{ $gender->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Agama</label>
            <select class="select2 form-control" name="religion" id="religion" disabled>
                <option value=""></option>
                @foreach($religions as $religion)
                <option value="{{ $religion->code }}">{{ $religion->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Keturunan</label>
            <select class="select2 form-control" name="race" id="race" disabled>
                <option value=""></option>
                @foreach($races as $race)
                <option value="{{ $race->code }}">{{ $race->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Tarikh Lahir</label>
            <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" value="" name="date_of_birth" id="date_of_birth" disabled />
        </div>

        {{-- <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Umur</label>
            <input type="text" class="form-control" value="" name="age" id="age" disabled>
        </div> --}}

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Taraf Perkahwinan</label>
            <select class="select2 form-control" name="marital_status" id="marital_status" disabled>
                <option value=""></option>
                @foreach($maritalStatuses as $maritalStatus)
                <option value="{{ $maritalStatus->code }}">{{ $maritalStatus->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">No. Telefon</label>
            <input type="text" class="form-control" value="" name="phone_number" id="phone_number" disabled>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Alamat Emel</label>
            <input type="text" class="form-control" value="" name="email" id="email" disabled>
        </div>
    </div>
</div>
<div id="button_action_personal" style="display:none">
        <button type="button" id="btnEditPersonal" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditPersonal').trigger('click');">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</form>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="update_personal" hidden onclick="editPersonal()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<script>
    function editPersonal() {
        $('#personalForm select[name="gender"]').attr('disabled', false);
        $('#personalForm select[name="religion"]').attr('disabled', false);
        $('#personalForm select[name="race"]').attr('disabled', false);
        $('#personalForm input[name="date_of_birth"]').attr('disabled', false);
        $('#personalForm select[name="marital_status"]').attr('disabled', false);
        $('#personalForm input[name="phone_number"]').attr('disabled', false);
        $('#personalForm input[name="email"]').attr('disabled', false);

        var button_action_personal = document.getElementById('button_action_personal').style.display = 'block';
    }

    function reloadPersonal() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPersonalUrl = "{{ route('personal.details', ':replaceThis') }}"
        reloadPersonalUrl = reloadPersonalUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPersonalUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#personalForm select[name="gender"]').val(data.detail.ref_gender_code).trigger('change');
                $('#personalForm select[name="religion"]').val(data.detail.ref_religion_code).trigger('change');
                $('#personalForm select[name="race"]').val(data.detail.ref_race_code).trigger('change');
                $('#personalForm input[name="date_of_birth"]').val(data.detail.date_of_birth);
                $('#personalForm select[name="marital_status"]').val(data.detail.ref_marital_status_code).trigger('change');
                $('#personalForm input[name="phone_number"]').val(data.detail.phone_number);
                $('#personalForm input[name="email"]').val(data.detail.email);
            },
            error: function(data) {
                //
            }
        });
    }
</script>