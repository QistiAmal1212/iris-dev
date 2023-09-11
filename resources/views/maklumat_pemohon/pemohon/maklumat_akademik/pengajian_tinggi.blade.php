<form id="higherEducationForm">
<div class="row mt-2 mb-2">
    {{-- <h6>
        <span class="badge badge-light-primary fw-bolder">Pengajian Tinggi : Ijazah</span>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6> --}}
    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Pengajian</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" name="tahun_pengajian_tinggi" id="tahun_pengajian_tinggi" disabled>
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Kelulusan</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">CGPA</label>
        <input type="text" class="form-control" value="" name="cgpa_pengajian_tinggi" id="cgpa_pengajian_tinggi" disabled>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Institusi</label>
        <select class="select2 form-control" name="institusi_pengajian_tinggi" id="institusi_pengajian_tinggi" disabled>
            <option value=""></option>
            @foreach($institutions as $institution)
            <option value="{{ $institution->code }}">{{ $institution->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Nama Sijil</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Pengkhususan/ Bidang</label>
        <select class="select2 form-control" value="" name="pengkhususan_pengajian_tinggi" disabled><option value=""></option>
            @foreach($specializations as $specialization)
            <option value="{{ $specialization->code }}">{{ $specialization->name }}</option>
            @endforeach
        </select>
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
        <a class="me-3 text-danger" type="button" id="update_institusi" hidden onclick="editInstitusi()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>

<script>

    function editInstitusi() {
        $('#higherEducationForm select[name="institusi_pengajian_tinggi"]').attr('disabled', false);
        $('#higherEducationForm select[name="institusi_pengajian_tinggi"]').attr('required', true);
    }

</script>