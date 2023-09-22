<div class="card" id="update_alamat" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editAlamat()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
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
        <input type="text" class="form-control" value="" name="permanent_address_1" id="permanent_address_1" oninput="checkInput('permanent_address_1', 'permanent_address_1Alert')" disabled>
        <div id="permanent_address_1Alert" style="color: red; font-size: smaller;"></div>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_2" id="permanent_address_2" oninput="checkInput('permanent_address_2', 'permanent_address_2Alert')" disabled>
        <div id="permanent_address_2Alert" style="color: red; font-size: smaller;"></div>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_3" id="permanent_address_3" oninput="checkInput('permanent_address_3', 'permanent_address_3Alert')" disabled>
        <div id="permanent_address_3Alert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="permanent_poscode" id="permanent_poscode" maxlength="5" oninput="onlyNumberOnInputText(this)" oninput="checkInput('permanent_poscode', 'permanent_poscodeAlert')" disabled>
        <div id="permanent_poscodeAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="permanent_city" id="permanent_city" oninput="checkInput('permanent_city', 'permanent_cityAlert')" disabled>
        <div id="permanent_cityAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="permanent_state" id="permanent_state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->kod }}">{{ $state->nama }}</option>
            @endforeach
        </select>
        <div id="permanent_stateAlert" style="color: red; font-size: smaller;"></div>
    </div>

    {{-- ALAMAT SURAT MENYURAT --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder mt-1">Alamat Surat Menyurat</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" value="" name="address_1" id="address_1" oninput="checkInput('address_1', 'address_1Alert')" disabled>
        <div id="address_1Alert" style="color: red; font-size: smaller;"></div>
        <br>
        <input type="text" class="form-control" value="" name="address_2" id="address_2" oninput="checkInput('address_2', 'address_2Alert')" disabled>
        <div id="address_2Alert" style="color: red; font-size: smaller;"></div>
        <br>
        <input type="text" class="form-control" value="" name="address_3" id="address_3" oninput="checkInput('address_3', 'address_3Alert')" disabled>
        <div id="address_3Alert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="poscode" id="poscode" maxlength="5" oninput="onlyNumberOnInputText(this)" oninput="checkInput('poscode', 'poscodeAlert')" disabled>
        <div id="poscodeAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="city" id="city" oninput="checkInput('city', 'cityAlert')" disabled>
        <div id="cityAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="state" id="state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->kod }}">{{ $state->nama }}</option>
            @endforeach
        </select>
        <div id="stateAlert" style="color: red; font-size: smaller;"></div>
    </div>
</div>
<div id="button_action_alamat" style="display:none">
    <button type="button" id="btnEditAlamat" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditAlamat', {
            permanent_address_1: $('#permanent_address_1').val(),
            permanent_address_2: $('#permanent_address_2').val(),
            permanent_address_3: $('#permanent_address_3').val(),
            permanent_poscode: $('#permanent_poscode').val(),
            permanent_city: $('#permanent_city').val(),
            permanent_state: $('#permanent_state').find(':selected').text(),
            address_1: $('#address_1').val(),
            address_2: $('#address_2').val(),
            address_3: $('#address_3').val(),
            poscode: $('#poscode').val(),
            city: $('#city').val(),
            state: $('#state').find(':selected').text(),
        },{
            permanent_address_1: 'Alamat Tetap(1)',
            permanent_address_2: 'Alamat Tetap(2)',
            permanent_address_3: 'Alamat Tetap(3)',
            permanent_poscode: 'Poskod Alamat Tetap',
            permanent_city: 'Bandar Alamat Tetap',
            permanent_state: 'Negeri Alamat Tetap',
            address_1: 'Alamat Menyurat(1)',
            address_2: 'Alamat Menyurat(2)',
            address_3: 'Alamat Menyurat(3)',
            poscode: 'Poskod Alamat Menyurat',
            city: 'Bandar Alamat Menyurat',
            state: 'Negeri Alamat Menyurat',
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>

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

        $("#button_action_alamat").attr("style", "display:block");
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
                $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_address_2"]').val(data.detail.permanent_address_2);
                $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_address_3"]').val(data.detail.permanent_address_3);
                $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_poscode"]').val(data.detail.permanent_poscode);
                $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_city"]').val(data.detail.permanent_city);
                $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                $('#alamatForm select[name="permanent_state"]').val(data.detail.permanent_ref_state_code).trigger('change');
                $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                $('#alamatForm input[name="address_1"]').val(data.detail.address_1);
                $('#alamatForm input[name="address_1"]').attr('disabled', true);
                $('#alamatForm input[name="address_2"]').val(data.detail.address_2);
                $('#alamatForm input[name="address_2"]').attr('disabled', true);
                $('#alamatForm input[name="address_3"]').val(data.detail.address_3);
                $('#alamatForm input[name="address_3"]').attr('disabled', true);
                $('#alamatForm input[name="poscode"]').val(data.detail.poscode);
                $('#alamatForm input[name="poscode"]').attr('disabled', true);
                $('#alamatForm input[name="city"]').val(data.detail.city);
                $('#alamatForm input[name="city"]').attr('disabled', true);
                $('#alamatForm select[name="state"]').val(data.detail.ref_state_code).trigger('change');
                $('#alamatForm select[name="state"]').attr('disabled', true);

                $("#button_action_alamat").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
