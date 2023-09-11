<form 
id="alamatForm"
action="{{ route('alamat.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadAlamat" 
data-reloadPage="false">
@csrf
<div class="row">
    
    <input type="hidden" name="alamat_no_pengenalan" id="alamat_no_pengenalan" value="">
    {{-- ALAMAT TETAP --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder">Alamat Tetap</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" value="" name="permanent_address_1" id="permanent_address_1" disabled>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_2" id="permanent_address_2" disabled>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_3" id="permanent_address_3" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="permanent_poscode" id="permanent_poscode" maxlength="5" oninput="onlyNumberOnInputText(this)" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="permanent_city" id="permanent_city" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="permanent_state" id="permanent_state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- ALAMAT SURAT MENYURAT --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder mt-1">Alamat Surat Menyurat</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" value="" name="address_1" id="address_1" disabled>
        <br>
        <input type="text" class="form-control" value="" name="address_2" id="address_2" disabled>
        <br>
        <input type="text" class="form-control" value="" name="address_3" id="address_3" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="poscode" id="poscode" maxlength="5" oninput="onlyNumberOnInputText(this)" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="city" id="city" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="state" id="state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="button_action_alamat" style="display:none">
        <button type="button" id="btnEditAlamat" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditAlamat').trigger('click');">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</form>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="update_alamat" hidden onclick="editAlamat()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>

<script>
    function editAlamat() {
        $('#alamatForm input[name="permanent_address_1"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_address_2"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_address_3"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_poscode"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_city"]').attr('disabled', false);
        $('#alamatForm select[name="permanent_state"]').attr('disabled', false);
        $('#alamatForm input[name="address_1"]').attr('disabled', false);
        $('#alamatForm input[name="address_2"]').attr('disabled', false);
        $('#alamatForm input[name="address_3"]').attr('disabled', false);
        $('#alamatForm input[name="poscode"]').attr('disabled', false);
        $('#alamatForm input[name="city"]').attr('disabled', false);
        $('#alamatForm select[name="state"]').attr('disabled', false);

        var button_action_alamat = document.getElementById('button_action_alamat').style.display = 'block';
    }

    function reloadAlamat() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadAlamatUrl = "{{ route('alamat.details', ':replaceThis') }}"
        reloadAlamatUrl = reloadAlamatUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadAlamatUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#alamatForm input[name="permanent_address_1"]').val(data.detail.permanent_address_1);
                $('#alamatForm input[name="permanent_address_2"]').val(data.detail.permanent_address_2);
                $('#alamatForm input[name="permanent_address_3"]').val(data.detail.permanent_address_3);
                $('#alamatForm input[name="permanent_poscode"]').val(data.detail.permanent_poscode);
                $('#alamatForm input[name="permanent_city"]').val(data.detail.permanent_city);
                $('#alamatForm select[name="permanent_state"]').val(data.detail.permanent_ref_state_code).trigger('change');
                $('#alamatForm input[name="address_1"]').val(data.detail.address_1);
                $('#alamatForm input[name="address_2"]').val(data.detail.address_2);
                $('#alamatForm input[name="address_3"]').val(data.detail.address_3);
                $('#alamatForm input[name="poscode"]').val(data.detail.poscode);
                $('#alamatForm input[name="city"]').val(data.detail.city);
                $('#alamatForm select[name="state"]').val(data.detail.ref_state_code).trigger('change');
            },
            error: function(data) {
                //
            }
        });
    }
</script>