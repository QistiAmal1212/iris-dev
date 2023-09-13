<div class="card" id="update_pengajian_tinggi" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPengajianTinggi()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="pengajianTinggiForm"
action="{{ route('pengajian-tinggi.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPengajianTinggi"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="pengajian_tinggi_no_pengenalan" id="pengajian_tinggi_no_pengenalan" value="">
    {{-- <h6>
        <span class="badge badge-light-primary fw-bolder">Pengajian Tinggi : Ijazah</span>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6> --}}
    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Pengajian</label>
        <select class="select2 form-control" value="" name="peringkat_pengajian_tinggi" id="peringkat_pengajian_tinggi"  disabled>
            <option value=""></option>
            @foreach($peringkatPengajian as $peringkat)
            <option value="{{ $peringkat->id }}">{{ $peringkat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" name="tahun_pengajian_tinggi" id="tahun_pengajian_tinggi" disabled>
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
        <label class="form-label">Peringkat Kelulusan</label>
        <select class="select2 form-control" value="" name="kelayakan_pengajian_tinggi" id="kelayakan_pengajian_tinggi" disabled>
            <option value=""></option>
            @foreach($eligibilities as $eligibility)
            <option value="{{ $eligibility->code }}">{{ $eligibility->name }}</option>
            @endforeach
        </select>
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
        <input type="text" class="form-control" value="" name="nama_sijil_pengajian_tinggi" id="nama_sijil_pengajian_tinggi" disabled>
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
        <select class="select2 form-control" value="" name="fln_pengajian_tinggi" id="fln_pengajian_tinggi" disabled>
            <option value=""></option>
            <option value="1">Tidak</option>
            <option value="2">Ya</option>
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tarikh Senat</label>
        <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_pengajian_tinggi" id="tarikh_senat_pengajian_tinggi" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Biasiswa</label>
        <select class="select2 form-control" value="" name="biasiswa_pengajian_tinggi" id="biasiswa_pengajian_tinggi" disabled>
            <option value=""></option>
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
        </select>
    </div>
</div>
<div id="button_action_pengajian_tinggi" style="display:none">
    <button type="button" id="btnEditPengajianTinggi" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="$('#btnEditPengajianTinggi').trigger('click');">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>

<script>

    function editPengajianTinggi() {
        $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').attr('disabled', false);
        $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').attr('disabled', false);

        $("#button_action_pengajian_tinggi").attr("style", "display:block");
    }

    function reloadPengajianTinggi() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPengajianTinggiUrl = "{{ route('pengajian-tinggi.details', ':replaceThis') }}"
        reloadPengajianTinggiUrl = reloadPengajianTinggiUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPengajianTinggiUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').val(data.detail.peringkat_pengajian).trigger('change');
                $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val(data.detail.year);
                $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val(data.detail.ref_eligibility_code).trigger('change');
                $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val(data.detail.cgpa);
                $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val(data.detail.ref_institution_code).trigger('change');
                $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val(data.detail.nama_sijil);
                $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val(data.detail.ref_specialization_code).trigger('change');
                $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val(data.detail.ins_fln).trigger('change');
                $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val(data.detail.tarikhSenat);
                $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val(data.detail.biasiswa).trigger('change');
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').attr('disabled', true);

                $("#button_action_pengajian_tinggi").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

</script>