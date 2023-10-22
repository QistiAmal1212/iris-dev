<div class="card" id="update_tempat_lahir" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editTempatLahir()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="tempatLahirForm"
action="{{ route('tempat-lahir.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadTempatLahir"
data-reloadPage="false">
@csrf
<div class="row">
    <input type="hidden" name="tempat_lahir_no_pengenalan" id="tempat_lahir_no_pengenalan" value="">
    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir</label>
        <select class="select2 form-control" name="place_of_birth" id="place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir Ayah</label>
        <select class="select2 form-control" name="father_place_of_birth" id="father_place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir Ibu</label>
        <select class="select2 form-control" name="mother_place_of_birth" id="mother_place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="button_action_tempat_lahir" style="display:none">
    <button type="button" id="btnEditTempatLahir" hidden onclick="generalFormSubmit(this);"></button>
    <div class="d-flex justify-content-end align-items-center my-1">
        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditTempatLahir', {
            place_of_birth: $('#place_of_birth').find(':selected').text(),
            father_place_of_birth: $('#father_place_of_birth').find(':selected').text(),
            mother_place_of_birth: $('#mother_place_of_birth').find(':selected').text(),
        },{
            place_of_birth: 'Tempat Lahir',
            father_place_of_birth: 'Tempat Lahir Ayah',
            mother_place_of_birth: 'Tempat Lahir Ibu',
        }
        );">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
<input type="hidden" name="tukar_log_lahir"  id="tukar_log_lahir">
</form>
<input type="hidden" name="editbutton_lahir" value=0 id="editbutton_lahir">

<textarea id="currentvalues_lahir" style="display:none;"></textarea>

<script>
    function checkiflahirempty() {
       var place_of_birth = $('#place_of_birth').find(':selected').text();
       var father_place_of_birth = $('#father_place_of_birth').find(':selected').text();
       var mother_place_of_birth = $('#mother_place_of_birth').find(':selected').text();
     
        var dontbypasslahir = false;
        if (!place_of_birth || place_of_birth == 'Tiada Maklumat' || place_of_birth =='') {
            if (!father_place_of_birth || father_place_of_birth == 'Tiada Maklumat' || father_place_of_birth =='') {
                if (!mother_place_of_birth || mother_place_of_birth == 'Tiada Maklumat' || mother_place_of_birth == '') {
                    dontbypasslahir = true;
                }   
            }
        }

        if (dontbypasslahir) {
            $('#tm_lahir').removeAttr('hidden');
        } else {
            $('#tm_lahir').attr("hidden", true);
        }
    }
    
    function editTempatLahir() {
        $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', false);
        $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', false);
        $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', false);

        $("#button_action_tempat_lahir").attr("style", "display:block");

        var editbuttoncount = $('#editbutton_lahir').val();
        console.log(editbuttoncount);
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_lahir').val(1)
            var check_data = {
                place_of_birth: $('#place_of_birth').find(':selected').text(),
                father_place_of_birth: $('#father_place_of_birth').find(':selected').text(),
                mother_place_of_birth: $('#mother_place_of_birth').find(':selected').text(),
            };
            $('#currentvalues_lahir').val(JSON.stringify(check_data));
        } else {
            checkkemaskinilahir();
        }
    }
    function checkkemaskinilahir() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_lahir').val());
   
        if (checkValue.place_of_birth != $('#place_of_birth').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.father_place_of_birth != $('#father_place_of_birth').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.mother_place_of_birth != $('#mother_place_of_birth').find(':selected').text()) {
            datachanged = true;
        }
        if (!datachanged) {
            $('#editbutton_lahir').val(0);
            disbalefieldslahir();
        }
    }
    function disbalefieldslahir() {
        $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', true);
        $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', true);
        $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', true);
    }
    function reloadTempatLahir() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadTempatLahirUrl = "{{ route('tempat-lahir.details', ':replaceThis') }}"
        reloadTempatLahirUrl = reloadTempatLahirUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadTempatLahirUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#tempatLahirForm select[name="place_of_birth"]').val(data.detail.tempat_lahir).trigger('change');
                $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', true);
                $('#tempatLahirForm select[name="father_place_of_birth"]').val(data.detail.tempat_lahir_bapa).trigger('change');
                $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', true);
                $('#tempatLahirForm select[name="mother_place_of_birth"]').val(data.detail.tempat_lahir_ibu).trigger('change');
                $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', true);

                $("#button_action_tempat_lahir").attr("style", "display:none");
                checkiflahirempty();
            },
            error: function(data) {
                //
            }
        });
    }
</script>
