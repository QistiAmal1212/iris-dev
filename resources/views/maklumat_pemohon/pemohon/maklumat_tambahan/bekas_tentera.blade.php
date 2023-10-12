<div class="card" id="update_tentera_polis" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editTenteraPolis()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="tenteraPolisForm"
action="{{ route('tentera-polis.update') }}"
method="POST"
data-refreshFunctionNameIfSuccess="reloadTenteraPolis" data-reloadPage="false">
@csrf
<div class="row">

    <input type="hidden" name="tentera_polis_no_pengenalan" id="tentera_polis_no_pengenalan" value="">
    {{-- <h6>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6> --}}
    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Kategori</label>
        <select class="select2 form-control" name="jenis_perkhidmatan_tentera_polis" id="jenis_perkhidmatan_tentera_polis" disabled>
            <option value=""></option>
            @foreach($jenisPerkhidmatan as $perkhidmatan)
            <option value="{{ $perkhidmatan->id }}">{{ $perkhidmatan->name }}</option>
            @endforeach
        <select>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Pangkat dalam Tentera</label>
        <select class="select2 form-control" name="pangkat_tentera_polis" id="pangkat_tentera_polis" disabled>
            <option value=""></option>
            @foreach($ranks as $rank)
            <option value="{{ $rank->kod }}">{{ $rank->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Jenis Penamatan Perkhidmatan</label>
        <select class="select2 form-control" name="jenis_bekas_tentera_polis" id="jenis_bekas_tentera_polis" disabled>
            <option value=""></option>
            @foreach($jenisBekasTenteraPolis as $bekas)
            <option value="{{ $bekas->code }}">{{ $bekas->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="button_action_tentera_polis" style="display:none">
    <button type="button" id="btnEditTenteraPolis" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditTenteraPolis',
        {
            jenis_perkhidmatan_tentera_polis: $('#jenis_perkhidmatan_tentera_polis').find(':selected').text(),
            pangkat_tentera_polis: $('#pangkat_tentera_polis').find(':selected').text(),
            jenis_bekas_tentera_polis: $('#jenis_bekas_tentera_polis').find(':selected').text(),
        },
        {
            jenis_perkhidmatan_tentera_polis: 'Kategori',
            pangkat_tentera_polis: 'Pangkat',
            jenis_bekas_tentera_polis: 'Jenis Penamatan Perkhidmatan',
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>

<script>
    function editTenteraPolis() {
        $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').attr('disabled', false);
        $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').attr('disabled', false);
        $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').attr('disabled', false);

        $("#button_action_tentera_polis").attr("style", "display:block");
    }

    function reloadTenteraPolis() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadTenteraPolisUrl = "{{ route('tentera-polis.details', ':replaceThis') }}"
        reloadTenteraPolisUrl = reloadTenteraPolisUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadTenteraPolisUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').val(data.detail.jenis_pkhidmat).trigger('change');
                $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').attr('disabled', true);
                $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').val(data.detail.pangkat_tentera_polis).trigger('change');
                $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').attr('disabled', true);
                $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').val(data.detail.jenis_bekas_tentera).trigger('change');
                $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').attr('disabled', true);
            },
            error: function(data) {
                //
            }
        });
    }
</script>
