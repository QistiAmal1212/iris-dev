<div class="card" id="update_oku" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editOKU()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="okuForm"
action="{{ route('oku.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadOKU"
data-reloadPage="false">
@csrf
    <div class="row">
        <input type="hidden" name="oku_no_pengenalan" id="oku_no_pengenalan" value="">
        <input type="hidden" name="temp" id="temp" value="">
        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">No. Pendaftaran OKU</label>
            <input type="text" class="form-control" value="" name="oku_registration_no" id="oku_registration_no" oninput="checkInput('oku_registration_no', 'oku_registration_noAlert')" disabled>
            <div id="oku_registration_noAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Status OKU</label>
            <input type="text" class="form-control" value="" name="oku_status" id="oku_status" oninput="checkInput('oku_status', 'oku_statusAlert')" disabled>
            <div id="oku_statusAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Kategori OKU</label>
            <select class="select2 form-control" name="oku_category" id="oku_category" disabled>
                <option value=""></option>
                @foreach($kategoriOKU as $kategori)
                <option value="{{ $kategori->kod_oku }}">{{ $kategori->kategori_oku }}</option>
                @endforeach
            </select>
            <div id="oku_categoryAlert" style="color: red; font-size: smaller;"></div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Sub- Kategori OKU</label>
            <select class="select2 form-control" name="oku_sub" id="oku_sub" disabled>
                <option value=""></option>
            </select>
        </div>
    </div>

    <div id="button_action_oku" style="display:none">
        <button type="button" id="btnEditOKU" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditOKU', {
                oku_registration_no: $('#oku_registration_no').val(),
                oku_status: $('#oku_status').val(),
                oku_category: $('#oku_category').find(':selected').text(),
                oku_sub: $('#oku_sub').find(':selected').text(),
            },{
                oku_registration_no: 'No. Pendaftaran OKU',
                oku_status: 'Status OKU',
                oku_category: 'Kategori OKU',
                oku_sub: 'Sub-Kategori OKU',
            }
            );">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
<input type="hidden" name="tukar_log_oku"  id="tukar_log_oku">
</form>
<input type="hidden" name="editbutton_oku" value=0 id="editbutton_oku">

<textarea id="currentvalues_oku" style="display:none;"></textarea>

<script>
     function checkiflahirempty() {
       var oku_registration_no = $('#oku_registration_no').val();
       var oku_status = $('#oku_status').val();
       var oku_category = $('#oku_category').find(':selected').text();
       var oku_sub = $('#oku_sub').find(':selected').text();

        var dontbypassoku = false;
        if (!oku_registration_no || oku_registration_no == 'Tiada Maklumat' || oku_registration_no =='') {
            if (!oku_status || oku_status == 'Tiada Maklumat' || oku_status =='') {
                if (!oku_category || oku_category == 'Tiada Maklumat' || oku_category == '') {
                    if (!oku_sub || oku_sub == 'Tiada Maklumat' || oku_sub == '') {
                        dontbypassoku = true;
                    }
                }
            }
        }

        if (dontbypassoku) {
            $('#tm_oku').removeAttr('hidden');
        } else {
            $('#tm_oku').attr("hidden", true);
        }
    }

    function editOKU() {
        $('#okuForm input[name="oku_registration_no"]').attr('disabled', false);
        $('#okuForm input[name="oku_status"]').attr('disabled', false);
        $('#okuForm select[name="oku_category"]').attr('disabled', false);
        $('#okuForm select[name="oku_sub"]').attr('disabled', false);

        $("#button_action_oku").attr("style", "display:block");

         var editbuttoncount = $('#editbutton_oku').val();
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_oku').val(1)
            var check_data = {
                oku_registration_no: $('#oku_registration_no').val(),
                oku_status: $('#oku_status').val(),
                oku_category: $('#oku_category').find(':selected').text(),
                oku_sub: $('#oku_sub').find(':selected').text()
            };
            $('#currentvalues_oku').val(JSON.stringify(check_data));
        } else {
            checkkemaskinioku();
        }
    }

    function checkkemaskinioku() {

        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_oku').val());

        if (checkValue.oku_registration_no != $('#oku_registration_no').val()) {
            datachanged = true;
        }
        if (checkValue.oku_status != $('#oku_status').val()) {
            datachanged = true;
        }
        if (checkValue.oku_category != $('#oku_category').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.oku_sub != $('#oku_sub').find(':selected').text()) {
            datachanged = true;
        }
        if (!datachanged) {
            $('#editbutton_oku').val(0);
            disbalefieldsoku();
        }
    }
    function disbalefieldsoku() {
        $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
        $('#okuForm input[name="oku_status"]').attr('disabled', true);
        $('#okuForm select[name="oku_category"]').attr('disabled', true);
        $('#okuForm select[name="oku_sub"]').attr('disabled', true);
    }

    function reloadOKU() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadOKUUrl = "{{ route('oku.details', ':replaceThis') }}"
        reloadOKUUrl = reloadOKUUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadOKUUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#okuForm input[name="oku_registration_no"]').val(data.detail.oku.no_daftar_jkm);
                $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
                $('#okuForm input[name="oku_status"]').val(data.detail.oku.status_oku);
                $('#okuForm input[name="oku_status"]').attr('disabled', true);
                $('#okuForm select[name="oku_category"]').val(data.detail.oku.kategori_oku);
                $('#okuForm select[name="oku_category"]').attr('disabled', true);
                $('#okuForm select[name="oku_sub"]').val(data.detail.oku.sub_oku);
                $('#okuForm select[name="oku_sub"]').attr('disabled', true);

                $("#button_action_oku").attr("style", "display:none");

                var tmOkuElement = $("#tm_oku");
                tmOkuElement.attr("hidden", true);
                checkiflahirempty();
            },
            error: function(data) {
                //
            }
        });
    }
</script>

