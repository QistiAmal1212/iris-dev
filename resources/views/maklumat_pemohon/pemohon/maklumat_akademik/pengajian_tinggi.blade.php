<style>
    #editButton {
        float: right;
    }
</style>
<!--  hide phase 1 -->
<!-- <div class="d-flex justify-content-end align-items-center mb-1" id="update_pengajian_tinggi" style="display:none;">
    <a class="me-3 text-danger" type="button" onclick="editPengajianTinggi()">
        <i class="fa-regular fa-pen-to-square"></i>
        Kemaskini
    </a>
</div>
 -->
{{-- START LOOP --}}
<form id="pengajianTinggiForm" action="{{ route('pt.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadPengajianTinggi" data-reloadPage="false">
    @csrf
    <div class="row mt-2 mb-2">
        <input type="hidden" name="pengajian_tinggi_no_pengenalan" id="pengajian_tinggi_no_pengenalan" value="">
        <input type="hidden" name="id_pt" id="id_pt" value="">
        {{-- <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
            <label class="form-label">Tahun</label>
            <input type="text" class="form-control" value="" name="tahun_pengajian_tinggi" id="tahun_pengajian_tinggi" oninput="checkInput('tahun_pengajian_tinggi', 'tahun_pengajian_tinggiAlert')" disabled>
            <div id="tahun_pengajian_tinggiAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
            <label class="form-label">Peringkat Pengajian</label>
            <select class="select2 form-control" value="" name="peringkat_pengajian_tinggi" id="peringkat_pengajian_tinggi" disabled>
                <option value="" hidden></option>
                    @foreach($peringkatPengajian as $peringkat)
                        <option value="{{ $peringkat->id }}">{{ $peringkat->diskripsi }}</option>
                    @endforeach
            </select>
        </div>
     <div class="col-sm-9 col-md-9 col-lg-9 mb-1">
            <label class="form-label">Peringkat Kelulusan</label>
            <select class="select2 form-control" value="" name="kelayakan_pengajian_tinggi" id="kelayakan_pengajian_tinggi" disabled>
                <option value="" hidden></option>
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
                <option value="" hidden></option>
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Francais Luar Negara</label>
            <select class="select2 form-control" value="" name="fln_pengajian_tinggi" id="fln_pengajian_tinggi" disabled>
                <option value="" hidden></option>
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
                <option value="" hidden></option>
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
        </div>  --}}
    </div>

    {{-- <div id="button_action_pt" style="display:none">
        <button type="button" id="btnEditPt" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-danger float-right" onclick="reloadPengajianTinggi()">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <!-- <button type="button" class="btn btn-success float-right" id="btnSavePt" onclick="$('#btnEditPt').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button> -->
            <button type="button" class="btn btn-success float-right" id="btnSavePt" onclick="confirmSubmitpt('btnEditPt', {
                tahun_pengajian_tinggi: $('#tahun_pengajian_tinggi').val(),
                fln_pengajian_tinggi: $('#fln_pengajian_tinggi').find(':selected').text(),
                biasiswa_pengajian_tinggi: $('#biasiswa_pengajian_tinggi').find(':selected').text(),
                tarikh_senat_pengajian_tinggi: $('#tarikh_senat_pengajian_tinggi').val(),
                pengkhususan_pengajian_tinggi: $('#pengkhususan_pengajian_tinggi').find(':selected').text(),
                institusi_pengajian_tinggi: $('#institusi_pengajian_tinggi').find(':selected').text(),
                kelayakan_pengajian_tinggi: $('#kelayakan_pengajian_tinggi').find(':selected').text(),
                peringkat_pengajian_tinggi: $('#peringkat_pengajian_tinggi').find(':selected').text(),
                nama_sijil_pengajian_tinggi: $('#nama_sijil_pengajian_tinggi').val(),
                cgpa_pengajian_tinggi: $('#cgpa_pengajian_tinggi').val(),

            },{
                nama_sijil_pengajian_tinggi: 'Nama Sijil',
                tahun_pengajian_tinggi: 'Tahun',
                fln_pengajian_tinggi: 'Francais Luar Negara',
                biasiswa_pengajian_tinggi: 'biasiswa_pengajian_tinggi',
                tarikh_senat_pengajian_tinggi: 'Tarikh Senat',
                pengkhususan_pengajian_tinggi: 'Pengkhususan/ Bidang',
                institusi_pengajian_tinggi: 'Institusi',
                cgpa_pengajian_tinggi: 'CGPA',
                kelayakan_pengajian_tinggi: 'Peringkat Kelulusan',
                peringkat_pengajian_tinggi: 'Peringkat Pengajian'
            }
        );">
            <i class="fa fa-save"></i> Tambah
        </button>
        </div>
    </div> --}}
<input type="hidden" name="tukar_log_pt"  id="tukar_log_pt">
</form>
<input type="hidden" name="editbutton_pt" value=0 id="editbutton_pt">

<textarea id="currentvalues_pt" style="display:none;"></textarea>

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
        var editbuttoncount = $('#editbutton_pt').val();
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_pt').val(1)
            var check_data = {
                tahun_pengajian_tinggi: $('#tahun_pengajian_tinggi').val(),
                fln_pengajian_tinggi: $('#fln_pengajian_tinggi').find(':selected').text(),
                biasiswa_pengajian_tinggi: $('#biasiswa_pengajian_tinggi').find(':selected').text(),
                tarikh_senat_pengajian_tinggi: $('#tarikh_senat_pengajian_tinggi').val(),
                pengkhususan_pengajian_tinggi: $('#pengkhususan_pengajian_tinggi').find(':selected').text(),
                institusi_pengajian_tinggi: $('#institusi_pengajian_tinggi').find(':selected').text(),
                kelayakan_pengajian_tinggi: $('#kelayakan_pengajian_tinggi').find(':selected').text(),
                peringkat_pengajian_tinggi: $('#peringkat_pengajian_tinggi').find(':selected').text(),
                nama_sijil_pengajian_tinggi: $('#nama_sijil_pengajian_tinggi').val(),
                cgpa_pengajian_tinggi: $('#cgpa_pengajian_tinggi').val()
            };
            $('#currentvalues_pt').val(JSON.stringify(check_data));
        } else {
            checkkemaskinipt();
        }
    }
    function checkkemaskinipt() {

        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_pt').val());

        if (checkValue.pengkhususan_pengajian_tinggi != $('#pengkhususan_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.institusi_pengajian_tinggi != $('#institusi_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.kelayakan_pengajian_tinggi != $('#kelayakan_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.peringkat_pengajian_tinggi != $('#peringkat_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }

        if (checkValue.nama_sijil_pengajian_tinggi != $('#nama_sijil_pengajian_tinggi').val()) {
            datachanged = true;
        }
         if (checkValue.cgpa_pengajian_tinggi != $('#cgpa_pengajian_tinggi').val()) {
            datachanged = true;
        }
         if (checkValue.tarikh_senat_pengajian_tinggi != $('#tarikh_senat_pengajian_tinggi').val()) {
            datachanged = true;
        }

        if (checkValue.tahun_pengajian_tinggi != $('#tahun_pengajian_tinggi').val()) {
            datachanged = true;
        }
         if (checkValue.fln_pengajian_tinggi != $('#fln_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }
         if (checkValue.biasiswa_pengajian_tinggi != $('#biasiswa_pengajian_tinggi').find(':selected').text()) {
            datachanged = true;
        }

        if (!datachanged) {
            $('#editbutton_pt').val(0);
            disbalefieldspt();
        }
    }
    function disbalefieldspt() {
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

        $("#button_action_pt").attr("style", "display:none");
    }
    function confirmSubmitpt(btnName, newValues, columnHead) {
        var originalVal = JSON.parse($('#currentvalues_pt').val());

        var htmlContent = '<p>Perubahan:</p>';
        for (var key in originalVal) {
            if (originalVal.hasOwnProperty(key)) {
                if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
                    if (originalVal[key] == null || originalVal[key] === '') {
                        if (newValues[key] !== 'Tiada Maklumat') {
                            if(newValues[key] !== null){
                                htmlContent += '<p>' + columnHead[key] + ':<br>';
                                htmlContent += 'Tiada Maklumat kepada ' + newValues[key] + '</p>';
                            }
                        }
                    } else {
                        htmlContent += '<p>' + columnHead[key] + ':<br>';
                        htmlContent += originalVal[key] + ' kepada ' + newValues[key] + '</p>';
                    }
                }
            }
        }
         if (htmlContent === '<p>Perubahan:</p>') {
            Swal.fire({
                title: 'Tiada Perubahan Dibuat',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        } else {
            $('#tukar_log_pt').val(htmlContent);
            $('#btnEditPt').trigger('click')
        }
        $('#editbutton_pt').val(0);
        reloadPengajianTinggi();
        disbalefieldspt();
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
                $('#editbutton_pt').val(0);
                $.each(data.detail, function(i, item) {
                    if(item){
                        trPt += '<hr><div class="row mt-2 mb-2"><div class="col-12 text-end mb-2">';
                        trPt += '</div>';
                        if(item.tahun_lulus){ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">Tahun</label><input type="text" class="form-control" value="' + item.tahun_lulus + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">Tahun</label><input type="text" class="form-control" value="Tiada" disabled></div>'; }
                        if(item.peringkat){ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Pengajian</label><input type="text" class="form-control" value="' + item.peringkat.diskripsi + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Pengajian</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.eligibility){ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Kelulusan</label><input type="text" class="form-control" value="' + item.eligibility.diskripsi + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-9 col-md-9 col-lg-9 mb-1"><label class="form-label">Peringkat Kelulusan</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.cgpa){ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">CGPA</label><input type="text" class="form-control" value="' + item.cgpa + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-3 col-md-3 col-lg-3 mb-1"><label class="form-label">CGPA</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.institution){ trPt += '<div class="col-sm-12 col-md-12 col-lg-12 mb-1"><label class="form-label">Institusi</label><input type="text" class="form-control" value="' + item.institution.diskripsi + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-12 col-md-12 col-lg-12 mb-1"><label class="form-label">Institusi</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.nama_sijil){ trPt += '<div class="col-sm-8 col-md-8 col-lg-8 mb-1"><label class="form-label">Nama Sijil</label><input type="text" class="form-control" value="' + item.nama_sijil + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-8 col-md-8 col-lg-8 mb-1"><label class="form-label">Nama Sijil</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.specialization){ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Pengkhususan/ Bidang</label><input type="text" class="form-control" value="' + item.specialization.diskripsi + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Pengkhususan/ Bidang</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.ins_fln){ item.ins_fln == 1 ? trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Tidak" disabled></div>' : trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Ya" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Francais Luar Negara</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.tarikh_senat){ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Tarikh Senat</label><input type="text" class="form-control" value="' + item.tarikh_senat + '" disabled></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Tarikh Senat</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div>'; }
                        if(item.biasiswa){ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Biasiswa</label><input type="text" class="form-control" value="' + item.biasiswa.diskripsi.toUpperCase() + '" disabled></div></div>'; }
                        else{ trPt += '<div class="col-sm-4 col-md-4 col-lg-4 mb-1"><label class="form-label">Biasiswa</label><input type="text" class="form-control" value="Tiada Maklumat" disabled></div></div>'; }
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
                    getDetails(ptEditData);
                    $('#editbutton_pt').val(0);
                    editPengajianTinggi();
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
                $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val(data.detail.biasiswa ? 1 : 0).trigger('change');

            }
        });
    }

</script>
