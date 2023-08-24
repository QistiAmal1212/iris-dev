<form id="higherEducationForm">
<div class="row mt-2 mb-2">
    <h6>
        <span class="badge badge-light-primary fw-bolder">Pengajian Tinggi : Ijazah</span>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6>
    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Pengajian</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Kelulusan</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">CGPA</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Institusi</label>
        <select class="select2 form-control" name="higher_education_institution" id="higher_education_institution" disabled>
            <option value=""></option>
            @foreach($institutions as $institution)
            <option value="{{ $institution->code }}">{{ $institution->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Nama Sijil</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">Pengkhususan/ Bidang</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Francais Luar Negara</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tarikh Senat</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Biasiswa</label>
        <input type="text" class="form-control" value="" disabled>
    </div>
</div>
</form>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editInstitution()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>

<script>

    function editInstitution() {
        $('#higherEducationForm select[name="higher_education_institution"]').attr('disabled', false);
        $('#higherEducationForm select[name="higher_education_institution"]').attr('required', true);
    }

</script>