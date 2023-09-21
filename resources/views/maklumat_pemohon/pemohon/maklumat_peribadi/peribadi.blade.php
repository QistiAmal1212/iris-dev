<style>
    .flatpickr-input[disabled]{
        background-color: #efefef;
    }
</style>
<div class="card" id="update_personal" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPersonal()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
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
            <div id="genderAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Agama</label>
            <select class="select2 form-control" name="religion" id="religion" disabled>
                <option value=""></option>
                @foreach($religions as $religion)
                <option value="{{ $religion->code }}">{{ $religion->name }}</option>
                @endforeach
            </select>
            <div id="religionAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Keturunan</label>
            <select class="select2 form-control" name="race" id="race" disabled>
                <option value=""></option>
                @foreach($races as $race)
                <option value="{{ $race->code }}">{{ $race->name }}</option>
                @endforeach
            </select>
            <div id="raceAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Tarikh Lahir</label>
            <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="date_of_birth" id="date_of_birth" oninput="checkInput('date_of_birth', 'date_of_birthAlert')" disabled />
            <div id="date_of_birthAlert" style="color: red; font-size: smaller;"></div>
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
            <div id="marital_statusAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">No. Telefon</label>
            <input type="text" class="form-control" value="" name="phone_number" id="phone_number" oninput="checkInput('phone_number', 'phone_numberAlert')" disabled>
            <div id="phone_numberAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Alamat Emel</label>
            <input type="text" class="form-control" value="" name="email" id="email" oninput="checkInput('email', 'emailAlert')" disabled>
            <div id="emailAlert" style="color: red; font-size: smaller;"></div>
        </div>
    </div>
</div>
<div id="button_action_personal" style="display:none">
    <button type="button" id="btnEditPersonal" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditPersonal', {
            gender: $('#gender').find(':selected').text(),
            religion: $('#religion').find(':selected').text(),
            race: $('#race').find(':selected').text(),
            date_of_birth: $('#date_of_birth').val(),
            marital_status: $('#marital_status').find(':selected').text(),
            phone_number: $('#phone_number').val(),
            email: $('#email').val()
        },{
            gender: 'Jantina',
            religion: 'Agama',
            race: 'Keturunan',
            date_of_birth: 'Tarikh Lahir',
            marital_status: 'Taraf Perkahwinan',
            phone_number: 'No. Telefon',
            email: 'Alamat Emel'
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>

<script>
    function editPersonal() {
        $('#personalForm select[name="gender"]').attr('disabled', false);
        $('#personalForm select[name="religion"]').attr('disabled', false);
        $('#personalForm select[name="race"]').attr('disabled', false);
        $('#personalForm input[name="date_of_birth"]').attr('disabled', false);
        $('#personalForm select[name="marital_status"]').attr('disabled', false);
        $('#personalForm input[name="phone_number"]').attr('disabled', false);
        $('#personalForm input[name="email"]').attr('disabled', false);

        $("#button_action_personal").attr("style", "display:block");
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
                $('#personalForm select[name="gender"]').attr('disabled', true);
                $('#personalForm select[name="religion"]').val(data.detail.ref_religion_code).trigger('change');
                $('#personalForm select[name="religion"]').attr('disabled', true);
                $('#personalForm select[name="race"]').val(data.detail.ref_race_code).trigger('change');
                $('#personalForm select[name="race"]').attr('disabled', true);
                $('#personalForm input[name="date_of_birth"]').val(data.detail.date_of_birth);
                $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                $('#personalForm select[name="marital_status"]').val(data.detail.ref_marital_status_code).trigger('change');
                $('#personalForm select[name="marital_status"]').attr('disabled', true);
                $('#personalForm input[name="phone_number"]').val(data.detail.phone_number);
                $('#personalForm input[name="phone_number"]').attr('disabled', true);
                $('#personalForm input[name="email"]').val(data.detail.email);
                $('#personalForm input[name="email"]').attr('disabled', true);

                $("#button_action_personal").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
