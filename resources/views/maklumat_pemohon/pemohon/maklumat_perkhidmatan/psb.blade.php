<form id="experienceForm">
<div class="row">
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
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Taraf Jawatan</label>
        <select class="select2 form-control" name="experience_position_level" disabled>
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
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Tarikh Pengesahan Lantikan</label>
        <input type="text" class="form-control" value="" name="experience_verify_date" id="experience_verify_date" disabled>
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
</form>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" hidden href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>