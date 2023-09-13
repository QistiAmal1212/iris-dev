<div class="card" id="update_pmr" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPmr()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form 
id="pmrForm"
action="{{ route('pmr.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPmr" 
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="pmr_no_pengenalan" id="pmr_no_pengenalan" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Mata Pelajaran</label>
        <select class="select2 form-control" value="" id="subjek_pmr" name="subjek_pmr" disabled>
            <option value=""></option>
            @foreach($subjekPmr as $subjek)
            <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="gred_pmr" name="gred_pmr" disabled>
            <option value=""></option>
            @foreach($gredPmr as $gred)
            <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" id="tahun_pmr" name="tahun_pmr" disabled>
    </div>

    <div id="button_action_pmr" style="display:none">
        <button type="button" id="btnEditPmr" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditPmr').trigger('click');">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</form>
</div>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-pmr">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Mata Pelajaran</th>
                <th>Gred</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    function editPmr() {
        $('#pmrForm select[name="subjek_pmr"]').attr('disabled', false);
        $('#pmrForm select[name="gred_pmr"]').attr('disabled', false);
        $('#pmrForm input[name="tahun_pmr"]').attr('disabled', false);

        $("#button_action_pmr").attr("style", "display:block");
    }

    function reloadPmr() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPmrUrl = "{{ route('pmr.list', ':replaceThis') }}"
        reloadPmrUrl = reloadPmrUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPmrUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pmrForm select[name="subjek_pmr"]').val('').trigger('change');
                $('#pmrForm select[name="gred_pmr"]').val('').trigger('change');
                $('#pmrForm input[name="tahun_pmr"]').val('');

                $('#table-pmr tbody').empty();
                    var trPmr = '';
                    var bilPmr = 0;
                    $.each(data.detail, function (i, item) {
                        if(item.subject != null) {
                            bilPmr += 1;
                            trPmr += '<tr>';
                            trPmr += '<td align="center">' + bilPmr + '</td>';
                            trPmr += '<td>' + item.subject.name + '</td>';
                            trPmr += '<td align="center">' + item.grade + '</td>';
                            trPmr += '<td align="center">' + item.year + '</td>';
                            trPmr += '</tr>';
                        }
                    });
                $('#table-pmr tbody').append(trPmr);
            },
            error: function(data) {
                //
            }
        });
    }
</script>