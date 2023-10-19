<style>
    #editButton {
        float: right;
    }
</style>
<div class="d-flex justify-content-end align-items-center mb-1" id="update_pengajian_tinggi" style="display:none">
    <a class="me-3 text-danger" type="button" onclick="editPengajianTinggi()">
        <i class="fa-regular fa-pen-to-square"></i>
        Kemaskini
    </a>
</div>

{{-- START LOOP --}}
<form id="pengajianTinggiForm" action="{{ route('pt.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadPengajianTinggi" data-reloadPage="false">
    @csrf
    <div class="row mt-2 mb-2">
        <input type="hidden" name="pengajian_tinggi_no_pengenalan" id="pengajian_tinggi_no_pengenalan" value="">
        <input type="hidden" name="id_pt" id="id_pt" value="">

        <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
            <label class="form-label">Tahun</label>
            <input type="text" class="form-control" value="" name="tahun_pengajian_tinggi" id="tahun_pengajian_tinggi" oninput="checkInput('tahun_pengajian_tinggi', 'tahun_pengajian_tinggiAlert')" disabled>
            <div id="tahun_pengajian_tinggiAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
            <label class="form-label">Peringkat Pengajian</label>
            <select class="select2 form-control" value="" name="peringkat_pengajian_tinggi" id="peringkat_pengajian_tinggi" disabled>
                <option value="" hidden>Peringkat Pengajian</option>
                    @foreach($peringkatPengajian as $peringkat)
                        <option value="{{ $peringkat->id }}">{{ $peringkat->diskripsi }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
            <label class="form-label">Peringkat Kelulusan</label>
            <select class="select2 form-control" value="" name="kelayakan_pengajian_tinggi" id="kelayakan_pengajian_tinggi" disabled>
                <option value="" hidden>Peringkat Kelulusan</option>
                    @foreach($eligibilities as $eligibility)
                        <option value="{{ $eligibility->kod }}">{{ $eligibility->diskripsi }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
            <label class="form-label">CGPA</label>
            <input type="text" class="form-control" value="" name="cgpa_pengajian_tinggi" id="cgpa_pengajian_tinggi" oninput="checkInput('cgpa_pengajian_tinggi', 'cgpa_pengajian_tinggiAlert')" disabled>
            <div id="cgpa_pengajian_tinggiAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
            <label class="form-label">Institusi</label>
            <select class="select2 form-control" name="institusi_pengajian_tinggi" id="institusi_pengajian_tinggi" disabled>
                <option value="" hidden>Institusi</option>
                    @foreach($institutions as $institution)
                        <option value="{{ $institution->kod }}">{{ $institution->diskripsi }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
            <label class="form-label">Nama Sijil</label>
            <input type="text" class="form-control" value="" name="nama_sijil_pengajian_tinggi" id="nama_sijil_pengajian_tinggi" oninput="checkInput('nama_sijil_pengajian_tinggi', 'nama_sijil_pengajian_tinggiAlert')" disabled>
            <div id="nama_sijil_pengajian_tinggiAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Pengkhususan/ Bidang</label>
            <select class="select2 form-control" value="" name="pengkhususan_pengajian_tinggi" id="pengkhususan_pengajian_tinggi" disabled>
                <option value="" hidden>Pengkhususan/ Bidang</option>
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Francais Luar Negara</label>
            <select class="select2 form-control" value="" name="fln_pengajian_tinggi" id="fln_pengajian_tinggi" disabled>
                <option value="" hidden>Francais Luar Negara</option>
                <option value="1">Tidak</option>
                <option value="2">Ya</option>
            </select>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Tarikh Senat</label>
            <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_pengajian_tinggi" id="tarikh_senat_pengajian_tinggi" oninput="checkInput('tarikh_senat_pengajian_tinggi', 'tarikh_senat_pengajian_tinggiAlert')" disabled>
            <div id="tarikh_senat_pengajian_tinggiAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Biasiswa</label>
            <select class="select2 form-control" value="" name="biasiswa_pengajian_tinggi" id="biasiswa_pengajian_tinggi" disabled>
                <option value="" hidden>Biasiswa</option>
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
        </div>
    </div>

    <div id="button_action_pt" style="display:none">
        <button type="button" id="btnEditPt" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-danger float-right" onclick="reloadPengajianTinggi()">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success float-right" id="btnSavePt" onclick="$('#btnEditPt').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>

<div id="list-pt">
</div>

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

        $("#button_action_pt").attr("style", "display:block");
    }

    function reloadPengajianTinggi() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPengajianTinggiUrl = "{{ route('pt.list', ':replaceThis') }}"
        reloadPengajianTinggiUrl = reloadPengajianTinggiUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPengajianTinggiUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').val('').trigger('change');
                $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val('');
                $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val('').trigger('change');
                $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val('');
                $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val('').trigger('change');
                $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val('');
                $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val('').trigger('change');
                $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val('').trigger('change');
                $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val('');
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val('').trigger('change');

                $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').attr('disabled', true);
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').attr('disabled', true);

                $('#pengajianTinggiForm').attr('action', "{{ route('pt.store')  }}");
                $('#btnSavePt').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_pt").attr("style", "display:none");

                $("#list-pt").empty();
                var trPt = '';

                $.each(data.detail, function(i, item) {
                    if(item){
                        trPt += '<hr><div class="row mt-2 mb-2"><div class="col-12 text-end mb-2">';
                        trPt += '<button class="btn btn-success editPt-btn" data-ptEdit="' + item.id + '" >Edit</button></div>';
                        if(item.tahun_lulus){ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">Tahun</label><input type="text" class="form-control" value="' + item.tahun_lulus + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">Tahun</label><input type="text" class="form-control" value="Tiada" readonly></div>'; }
                        if(item.peringkat){ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Pengajian</label><input type="text" class="form-control" value="' + item.peringkat.diskripsi + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Pengajian</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.eligibility){ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Kelulusan</label><input type="text" class="form-control" value="' + item.eligibility.diskripsi + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Kelulusan</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.cgpa){ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">CGPA</label><input type="text" class="form-control" value="' + item.cgpa + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">CGPA</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.institution){ trPt += '<div class="col-sm-12 col-md-12 col-lg-12 mb-1"><label class="form-label">Institusi</label><input type="text" class="form-control" value="' + item.institution.diskripsi + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-12 col-md-12 col-lg-12 mb-1"><label class="form-label">Institusi</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.nama_sijil){ trPt += '<div class="col-sm-8 col-md-8 col-lg-8 mb-1"><label class="form-label">Nama Sijil</label><input type="text" class="form-control" value="' + item.nama_sijil + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-8 col-md-8 col-lg-8 mb-1"><label class="form-label">Nama Sijil</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.specialization){ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Pengkhususan/ Bidang</label><input type="text" class="form-control" value="' + item.specialization.diskripsi + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Pengkhususan/ Bidang</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.ins_fln){ item.ins_fln == 1 ? trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Tidak" readonly></div>' : trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Ya" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.tarikh_senat){ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Tarikh Senat</label><input type="text" class="form-control" value="' + item.tarikh_senat + '" readonly></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Tarikh Senat</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div>'; }
                        if(item.biasiswa){ item.biasiswa == 0 ? trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Biasiswa</label><input type="text" class="form-control" value="Tidak" readonly></div></div>' : trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Biasiswa</label><input type="text" class="form-control" value="Ya" readonly></div></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Biasiswa</label><input type="text" class="form-control" value="Tiada Maklumat" readonly></div></div>'; }
                    }
                });
                $("#list-pt").append(trPt);

                if ($("#list-pt").is(':empty')) {
                    var tmPtElement = $("#tm_pt");
                    tmPtElement.removeAttr("hidden");
                } else {
                    var tmPtElement = $("#tm_pt");
                    tmPtElement.attr("hidden", true);
                }

                $(".editPt-btn").click(function() {
                    var ptEditData = $(this).data("ptedit");
                    getDetails(ptEditData)
                });
            },
            error: function(data) {
            }
        });
    }

    function getDetails(id){
        $('#btnSavePt').html('<i class="fa fa-save"></i> Simpan');
        $('#pengajianTinggiForm').attr('action', "{{ route('pt.update') }}");
        var url = "{{ route('pt.detail', ':replaceThis') }}"
        url = url.replace(':replaceThis', id);
        $.ajax({
            url: url,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pengajianTinggiForm input[name="id_pt"]').val(id);
                $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val(data.detail.tahun_lulus ? data.detail.tahun_lulus : '');
                $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').val(data.detail.peringkat_pengajian ? data.detail.peringkat_pengajian : '' ).trigger('change');
                $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val(data.detail.kel_kod ? data.detail.kel_kod : '').trigger('change');
                $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val(data.detail.cgpa ? data.detail.cgpa : '');
                $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val(data.detail.ins_kod ? data.detail.ins_kod : '').trigger('change');
                $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val(data.detail.nama_sijil ? data.detail.nama_sijil : '');
                $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val(data.detail.pen_kod ? data.detail.pen_kod : '').trigger('change');
                $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val(data.detail.ins_fln ? data.detail.ins_fln : '').trigger('change');
                $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val(data.detail.tarikh_senat ? data.detail.tarikh_senat : '');
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val(data.detail.biasiswa ? data.detail.biasiswa : '').trigger('change');

            }
        });
    }

</script>
