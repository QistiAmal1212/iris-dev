<div class="card" id="update_pusat_temuduga" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPusatTemuduga()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="pusatTemudugaForm"
action="{{ route('pusat-temuduga.update') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPusatTemuduga"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="pusat_temuduga_no_pengenalan" id="pusat_temuduga_no_pengenalan" value="">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Pusat Temuduga</label>
        <select class="select2 form-control" value="" id="pusat_temuduga" name="pusat_temuduga" disabled>
            <option value=""></option>
            @foreach($pusatTemuduga as $pusat)
            <option value="{{ $pusat->kod }}">{{ $pusat->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div id="button_action_pusat_temuduga" style="display:none">
        <button type="button" id="btnEditPusatTemuduga" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditPusatTemuduga', {
                pusat_temuduga: $('#pusat_temuduga').find(':selected').text(),
            },{
                pusat_temuduga: 'Pusat Temuduga',
            }
            );">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</div>
<input type="hidden" name="tukar_log_skim"  id="tukar_log_skim">
</form>
<input type="hidden" name="editbutton_skim" value=0 id="editbutton_skim">

<textarea id="currentvalues_skim" style="display:none;"></textarea>


<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-skim">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Kod Skim</th>
                <th>Nama Skim</th>
                <th>Tarikh Daftar Pertama</th>
                <th>Tarikh Daftar</th>
                <th>Tarikh Luput</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    function checkiflahirempty() {
       var pusat_temuduga = $('#pusat_temuduga').find(':selected').text();
       
        var dontbypassskim = false;
        if (!pusat_temuduga || pusat_temuduga == 'Tiada Maklumat' || pusat_temuduga =='') {
            dontbypassskim = true;
        }

        if (dontbypassskim) {
            $('#tm_skim').removeAttr('hidden');
        } else {
            $('#tm_skim').attr("hidden", true);
        }
    }
    function editPusatTemuduga() {
        $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', false);

        $("#button_action_pusat_temuduga").attr("style", "display:block");
        var editbuttoncount = $('#editbutton_skim').val();
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_skim').val(1)
            var check_data = {
                pusat_temuduga : $('#pusat_temuduga').find(':selected').text()
            };
            $('#currentvalues_skim').val(JSON.stringify(check_data));
        } else {
            checkkemaskiniskim();
        }
    }
    function checkkemaskiniskim() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_skim').val());
        if (checkValue.pusat_temuduga != $('#pusat_temuduga').find(':selected').text()) {
            datachanged = true;
        }
        if (!datachanged) {
            $('#editbutton_skim').val(0);
            disbalefieldsskim();
        }
    }
    function disbalefieldsskim() {
        $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', true);
    }
    function reloadPusatTemuduga() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPusatTemudugaUrl = "{{ route('pusat-temuduga.details', ':replaceThis') }}"
        reloadPusatTemudugaUrl = reloadPusatTemudugaUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPusatTemudugaUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pusatTemudugaForm select[name="pusat_temuduga"]').val(data.detail.pusat_temuduga).trigger('change');
                $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', true);

                $("#button_action_pusat_temuduga").attr("style", "display:none");
                checkiflahirempty();
            },
            error: function(data) {
                //
            }
        });
    }
</script>
