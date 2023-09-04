<style>
    .flatpickr-input[readonly]{
        background-color: #efefef;
    }
</style>
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

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tarikh Lahir</label>
        <input type="text" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="" name="date_of_birth" id="date_of_birth" disabled />
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Umur</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
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

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>