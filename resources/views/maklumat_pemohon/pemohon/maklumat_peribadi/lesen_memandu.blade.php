<div class="card" id="update_lesen_memandu" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editLesenMemandu()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="lesenMemanduForm"
action="{{ route('lesen-memandu.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadLesenMemandu"
data-reloadPage="false">
@csrf

<div class="row">
    <input type="hidden" name="lesen_memandu_no_pengenalan" id="lesen_memandu_no_pengenalan" value="">
    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Jenis Lesen</label>
        <input type="text" class="form-control" value="" name="license_type" id="license_type" oninput="checkInput('license_type', 'license_typeAlert')" disabled>
        <div id="license_typeAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tarikh Tamat</label>
        <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="license_expiry_date" id="license_expiry_date" oninput="checkInput('license_expiry_date', 'license_expiry_dateAlert')" disabled />
        <div id="license_expiry_dateAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Status Senarai Hitam</label>
        <select class="select2 form-control" name="license_blacklist_status" id="license_blacklist_status" disabled>
            <option value=""></option>
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Butiran Senarai Hitam</label>
        <textarea rows="3" class="form-control" name="license_blacklist_details" id="license_blacklist_details" oninput="checkInput('license_blacklist_details', 'license_blacklist_detailsAlert')" disabled>
        </textarea>
        <div id="license_blacklist_detailsAlert" style="color: red; font-size: smaller;"></div>
    </div>
</div>

<div id="button_action_lesen_memandu" style="display:none">
    <button type="button" id="btnEditLesenMemandu" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditLesenMemandu', {
            license_type: $('#license_type').val(),
            license_expiry_date: $('#license_expiry_date').val(),
            license_blacklist_status: $('#license_blacklist_status').find(':selected').text(),
            license_blacklist_details: $('#license_blacklist_details').val(),
        },{
            license_type: 'Jenis Lesen',
            license_expiry_date: 'Tarikh Tamat',
            license_blacklist_status: 'Status Senarai Hitam',
            license_blacklist_details: 'Butiran Senarai Hitam',
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
<input type="hidden" name="tukar_log_lessen"  id="tukar_log_lessen">
</form>
<input type="hidden" name="editbutton_lessen" value=0 id="editbutton_lessen">

<textarea id="currentvalues_lessen" style="display:none;"></textarea>
<script>

    function checkiflessenempty() {
       var license_type = $('#license_type').val();
       var license_expiry_date = $('#license_expiry_date').val();
       var license_blacklist_status = $('#license_blacklist_status').find(':selected').text();
       var license_blacklist_details = $('#license_blacklist_details').val();
     
        var dontbypasslessen = false;
        if (!license_type || license_type == 'Tiada Maklumat' || license_type =='') {
            if (!license_expiry_date || license_expiry_date == 'Tiada Maklumat' || license_expiry_date =='') {
                if (!license_blacklist_status || license_blacklist_status == 'Tiada Maklumat' || license_blacklist_status == '') {
                    if (!license_blacklist_details || license_blacklist_details == 'Tiada Maklumat' || license_blacklist_details == '') {
                        dontbypasslessen = true;
                    }
                }   
            }
        }

        if (dontbypasslessen) {
            $('#tm_lesen').removeAttr('hidden');
        } else {
            $('#tm_lesen').attr("hidden", true);
        }
    }

    function editLesenMemandu() {
        $('#lesenMemanduForm input[name="license_type"]').attr('disabled', false);
        $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', false);
        $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', false);
        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', false);

        $("#button_action_lesen_memandu").attr("style", "display:block");

        var editbuttoncount = $('#editbutton_lessen').val();
    
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_lessen').val(1)
            var check_data = {
                license_type: $('#license_type').val(),
                license_expiry_date: $('#license_expiry_date').val(),
                license_blacklist_status: $('#license_blacklist_status').find(':selected').text(),
                license_blacklist_details: $('#license_blacklist_details').val()
            };
            $('#currentvalues_lessen').val(JSON.stringify(check_data));
        } else {
            checkkemaskinilessen();
        }
    }
     function checkkemaskinilessen() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_lessen').val());
   
        if (checkValue.license_type != $('#license_type').val()) {
            datachanged = true;
        }
        if (checkValue.license_expiry_date != $('#license_expiry_date').val()) {
            datachanged = true;
        }
        if (checkValue.license_blacklist_details != $('#license_blacklist_details').val()) {
            datachanged = true;
        }
        if (checkValue.license_blacklist_status != $('#license_blacklist_status').find(':selected').text()) {
            datachanged = true;
        }
        
        if (!datachanged) {
            $('#editbutton_lessen').val(0);
            disbalefieldslessen();
        }
    }
    function disbalefieldslessen() {
        $('#lesenMemanduForm input[name="license_type"]').attr('disabled', true);
        $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', true);
        $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', true);
        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', true);
    }
    function reloadLesenMemandu() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadLesenMemanduUrl = "{{ route('lesen-memandu.details', ':replaceThis') }}"
        reloadLesenMemanduUrl = reloadLesenMemanduUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadLesenMemanduUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#lesenMemanduForm input[name="license_type"]').val(data.detail.license.jenis_lesen);
                $('#lesenMemanduForm input[name="license_type"]').attr('disabled', true);
                $('#lesenMemanduForm input[name="license_expiry_date"]').val(data.detail.license.tempoh_tamat);
                $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', true);
                $('#lesenMemanduForm select[name="license_blacklist_status"]').val(data.detail.license.status_senaraihitam).trigger('change');
                $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', true);
                $('#lesenMemanduForm textarea[name="license_blacklist_details"]').val(data.detail.license.msg_senaraihitam);
                $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', true);

                $("#button_action_lesen_memandu").attr("style", "display:none");

                var tmLesenElement = $("#tm_lesen");
                tmLesenElement.attr("hidden", true);
                checkiflessenempty();
            },
            error: function(data) {
                //
            }
        });
    }
</script>
